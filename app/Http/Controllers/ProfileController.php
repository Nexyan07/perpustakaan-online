<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fines;
use App\Models\Peminjam;
use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $reservation = Reservations::where('user_id', Auth::id())->where('expiration_date', '>=', Carbon::now())->get();
        $peminjam = Peminjam::where('user_id', Auth::id())->where('dirating', 0)->get();
        $denda = Fines::whereHas('user', function ($q) {
            $q->where('id', Auth::id());
        })->where('status_pembayaran', 'belum dibayar')->get();
        return view('profile', ['reservation' => $reservation, 'peminjam' => $peminjam, 'denda' => $denda]);
    }

    public function show()
    {
        return view('edit_profile');
    }
}
