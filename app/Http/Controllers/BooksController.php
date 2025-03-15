<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Genres;
use App\Models\BooksGenres;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $genres = Genres::select('id', 'name')->get();
        $books = Books::Filter(request(['keyword']))->latest()->paginate(20)->withQueryString();

        return view('admin.books', ['books' => $books, 'genres' => $genres, 'keyword' => $keyword]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required',
            'copies_total' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0|max:' . $request->input('copies_total'),
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator) // Mengirimkan error default Laravel
                ->withInput()
                ->with('status', 'error') // Menambahkan status secara khusus
                ->with('message', 'Validasi Gagal. Periksa kembali data yang Anda masukkan.');
        }
        
        try {
            // validate foto
            $foto = $request->file('foto');
            $originalName = $foto->getClientOriginalName();
            $fotoName = time() . '_' . $originalName;
            $foto->move(public_path('img/books'), $fotoName);

            $book = Books::create([
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
                'isbn' => $request->isbn,
                'copies_total' => $request->copies_total,
                'copies_available' => $request->copies_available,
                'foto' => $fotoName,
                'description' => $request->description,
                'slug' => Str::slug($request->title, '-'),
            ]);

            if($request->has('genres')) {
                $genres = json_decode(request('genres'));
                foreach($genres as $genre) {
                    $genreId = Genres::where('name', $genre)->value('id');
                    BooksGenres::create([
                        'books_id' => $book->id,
                        'genres_id' => $genreId,
                    ]);
                }
            }
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Ditambahkan');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
        
    }
 
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required',
            'copies_total' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0|max:' . $request->input('copies_total'),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator) // Mengirimkan error default Laravel
                ->withInput()
                ->with('status', 'error') // Menambahkan status secara khusus
                ->with('message', 'Validasi Gagal. Periksa kembali data yang Anda masukkan.');
        }
        
        try {
            $validated = $validator->validated();
            $book = Books::findOrFail($id);

            if ($request->hasFile('foto')) {
                // hapus gambar lama
                if ($book->foto && file_exists(public_path('img/books/' . $book->foto))) {
                    unlink(public_path('img/books/' . $book->foto));
                }

                // simpan gambar baru
                $foto = $request->file('foto');
                $originalName = $foto->getClientOriginalName();
                $fotoName = time() . '_' . $originalName;
                $foto->move(public_path('img/books'), $fotoName);
                $book->foto = $fotoName; //simpan foto ke database
            } else {
                $book->foto = $book->foto;
            }

            // update data lainnya
            $book->update([
                'title' => $validated['title'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'year' => $validated['year'],
                'isbn' => $validated['isbn'],
                'copies_total' => $validated['copies_total'],
                'copies_available' => $validated['copies_available'],
                'description' => $validated['description'],
            ]);

            if($request->has('genres')) {
                $bookGenre = BooksGenres::where('books_id', $book->id);
                $genres = json_decode(request('genres'));
                if(count($genres) !== $bookGenre->count()) {
                    $bookGenre->delete();
                    foreach($genres as $genre) {
                        $genreId = Genres::where('name', $genre)->value('id');
                        BooksGenres::create([
                            'books_id' => $book->id,
                            'genres_id' => $genreId,
                        ]);
                    }
                } elseif (count($genres) === $bookGenre->count()) {
                    foreach($genres as $genre) {
                    $genreId = Genres::where('name', $genre)->value('id');
                    $bookGenre->update([
                        'books_id' => $book->id,
                        'genres_id' => $genreId,
                    ]);
                    }
                }
            }
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Update');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $book = Books::findOrFail($id);

            // hapus img dari folder
            if($book->foto && file_exists(public_path('img/books/' . $book->foto))){
                unlink(public_path('img/books/' . $book->foto));
            }

            $book->delete();
            
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Hapus');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function highestRating()
    {
        $books = Books::withAvg('ratings', 'rating')->withCount('ratings')->orderBy('ratings_avg_rating', 'desc')->take(2)->get();
        return view('home', ['books' => $books]);
    }
}
