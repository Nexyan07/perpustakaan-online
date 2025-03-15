<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Genres;
use App\Models\BooksGenres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookGenresController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $books = Books::all();
        $genres = Genres::all();
        $book_genres = BooksGenres::Filter(request(['keyword']))->orderBy('books_id', 'ASC')->latest()->paginate(20)->withQueryString();

        return view('admin/book_genres', ['book_genres' => $book_genres, 'books' => $books, 'genres' => $genres, 'keyword' => $keyword]); // Kirim data ke view
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'books' => 'required|max:255',
            'genres' => 'required|max:255',
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
            BooksGenres::create([
                'books_id' => $request->books,
                'genres_id' => $request->genres,
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Ditambahkan');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'books' => 'required|max:255',
            'genres' => 'required|max:255',
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
            BooksGenres::where('id', $id)->update([
                'books_id' => $request->books,
                'genres_id' => $request->genres,
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Diubah');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Diubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $book_genres = BooksGenres::findOrFail($id);
            $book_genres->delete();
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Dihapus');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Dihapus: ' . $e->getMessage());
        }
    }
}
