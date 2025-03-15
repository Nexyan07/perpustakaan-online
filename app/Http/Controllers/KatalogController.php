<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index($slug)
    {
        $user = Auth::user();
        $book = Books::where('slug', $slug)->firstOrFail();
        $genres = $book->genres;
        
        return view('katalog', ['user' => $user, 'book' => $book, 'genres' => $genres]);
    }

    public function store(Request $request, $id)
    {
        $book = Books::findOrFail($id);
        $reservationCount = Reservations::where('user_id', Auth::id())->count();
        
        if($book->copies_available === 0) {
            return redirect()->back()->with('status', 'error')->with('message', 'Maaf, buku sedang tidak tersedia saat ini');
        }

        if($reservationCount >= 2) {
            return redirect()->back()->with('status', 'error')->with('message', 'Anda sudah mencapai batas maksimal reservasi');
        }

        try {
            Reservations::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'reserved_at' => now(),
                'expiration_date' => now()->addDays(2),
            ]);

            $book->copies_available = $book->copies_available - 1;
            $book->save();
            
            return redirect(route('reservation.show', $book->slug))->with('status', 'success')->with('message', 'Tunjukan bukti reservasi ke petugas perpustakaan untuk mengambil buku. Selamat membaca 😊');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Gagal reservasi, Hubungi layanan perpustakaan untuk bantuan lebih lanjut' . $e->getMessage());
        }
    }
}
