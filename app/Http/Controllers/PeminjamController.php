<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Books;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $peminjam = Peminjam::Filter(request(['keyword']))->latest()->paginate(20);
        $books = Books::all();
        $users = User::all();

        return view('admin.peminjam', ['peminjam' => $peminjam, 'books' => $books, 'users' => $users, 'keyword' => $keyword]);
    }

    public function peminjamanUser()
    {
        $peminjam = Peminjam::where('user_id', Auth::id())->whereNull('tanggal_pengembalian')->get();
        $peminjamBelumRating = Peminjam::where('user_id', Auth::id())->where('dirating', 0)->whereNotNull('tanggal_pengembalian')->get();
        return view('peminjamanBuku', ['peminjam' => $peminjam, 'peminjamBelumRating' => $peminjamBelumRating]);
    }

    public function show($slug)
    {
        $book = Books::where('slug', $slug)->firstOrFail();
        $peminjam = Peminjam::where('user_id', Auth::id())->whereHas('book', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();
        return view('detailPeminjamanBuku', ['peminjam' => $peminjam, 'book' => $book]);
    }

    public function store(Request $request)
    {
        $book = Books::where('id', $request->book)->first();
        if($book->copies_available === 0) {
            return redirect()->back()->with('status', 'error')->with('message', 'Buku sedang tidak tersedia');
        }
    
        $book->copies_available = $book->copies_available - 1;
        $book->save();

        $validator = Validator::make($request->all(), [
            'user' => 'required|max:255',
            'book' => 'required|max:255',
            'tanggal_pinjam' => 'required|max:255',
            'tanggal_pengembalian' => 'nullable|max:255',
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
            Peminjam::create([
                'user_id' => $request->user,
                'book_id' => $request->book,
                'tanggal_pinjam' => $tanggal_pinjam = Carbon::parse($request->tanggal_pinjam),
                'tenggat_pengembalian' => $tanggal_pinjam->copy()->addDays(7),
                'tanggal_pengembalian' => isset($request->tanggal_pengembalian) ? Carbon::parse($request->tanggal_pengembalian) : null,
            ]);


            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Ditambahkan');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|max:255',
            'book' => 'required|max:255',
            'tanggal_pinjam' => 'required|max:255',
            'tanggal_pengembalian' => 'nullable|max:255',
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
            $peminjam = Peminjam::findOrFail($id);

            $peminjam->update([
                'user_id' => $request->user,
                'book_id' => $request->book,
                'tanggal_pinjam' => $tanggal_pinjam = Carbon::parse($request->tanggal_pinjam),
                'tenggat_pengembalian' => $tanggal_pinjam->copy()->addDays(7),
                'tanggal_pengembalian' => isset($request->tanggal_pengembalian) ? Carbon::parse($request->tanggal_pengembalian) : null,
            ]);

            $book = Books::where('id', $request->book)->first();
            if(isset($request->tanggal_pengembalian)) {
                $book->copies_available = $book->copies_available + 1;
                $book->save();
            }

            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Update');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $peminjam = Peminjam::findOrFail($id);
            $peminjam->delete();
            
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Hapus');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function peminjamanClear($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $peminjam->tanggal_pengembalian = now();
        $peminjam->save();

        return redirect()->back()->with('status', 'success')->with('message', 'Buku dikembalikan');
    }
}
