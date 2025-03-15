<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Books;
use App\Models\Peminjam;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::select('id', 'name')->get();
        $books = Books::select('id', 'title')->get();
        $reservations = Reservations::filter(['keyword' => $keyword])->latest()->paginate(20)->withQueryString();
        return view('admin/reservations', ['reservations' => $reservations, 'users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users' => 'required',
            'books' => 'required',
            'reserved_at' => 'required|date',
            'expiration_date' => 'required|date',
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
            Reservations::create([
                'user_id' => $request->users,
                'book_id' => $request->books,
                'reserved_at' => $request->reserved_at,
                'expiration_date' => $request->expiration_date,
            ]);

            $book = Books::where('id', $request->books)->first();
            $book->copies_available = $book->copies_available - 1;
            $book->save();

            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Ditambahkan');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'users' => 'required',
            'books' => 'required',
            'reserved_at' => 'required|date',
            'expiration_date' => 'required|date',
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
            $reservation = Reservations::findOrFail($id);
            $reservation->update([
                'user_id' => $request->users,
                'book_id' => $request->books,
                'reserved_at' => $request->reserved_at,
                'expiration_date' => $request->expiration_date,
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Diubah');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Diubah: ' . $e->getMessage());
        }
    }

    public function userReservation(Request $request)
    {
        $reservations = Reservations::where('user_id', Auth::id())->where('expiration_date', '>=', Carbon::now())->get();
        return view('reservations', ['reservations' => $reservations]);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $reservation = Reservations::findOrFail($id);
            $book = Books::where('id', $reservation->book_id)->first();
            $book->copies_available = $book->copies_available + 1;
            $book->save();
            $reservation->delete();

            if($request->segment(1) == 'table-reservations') {
                return redirect()->back()->with('status', 'success')->with('message', 'Reservasi berhasil dihapus');
            }

            return redirect('/reservations')->with('status', 'success')->with('message', 'Reservasi berhasil dibatalkan');
        } catch (\Exception $e) {
            return redirect('/reservations')->with('status', 'error')->with('message', 'Gagal membatalkan reservasi, Hubungi layanan perpustakaan untuk bantuan lebih lanjut' . $e->getMessage());
        }
    }

    public function show(Request $request, $slug)
    {
        $book = Books::where('slug', $slug)->firstOrFail();
        $reservation = Reservations::where('user_id', Auth::id())->whereHas('book', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();
        return view('reservation', ['reservation' => $reservation, 'book' => $book]);
    }

    public function reservationClear(Request $request, $id)
    {
        try {
            Peminjam::create([
                'user_id' => $request->users,
                'book_id' => $request->books,
                'tanggal_pinjam' => $tanggal_pinjam = Carbon::parse($request->tanggal_pinjam),
                'tenggat_pengembalian' => $tanggal_pinjam->copy()->addDays(7),
            ]);

            $reservation = Reservations::findOrFail($id);
            $reservation->delete();

            return redirect()->back()->with('status', 'success')->with('message', 'Peminjaman berhasil');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Peminjaman gagal : ' . $e->getMessage());
        }
    }
}
