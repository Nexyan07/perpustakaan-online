<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use App\Models\Fines;
use App\Models\Peminjam;
use App\Models\Reservations;


class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $books = Books::count();
        $peminjam = Peminjam::where('tanggal_pengembalian', null)->count();
        $reservations = Reservations::count();
        $fines = Fines::where('status_pembayaran', 'belum dibayar')->count();
        
        return view('admin.dashboard', ['users' => $users, 'books' => $books, 'peminjam' => $peminjam, 'reservations' => $reservations, 'fines' => $fines]);
    }
}
