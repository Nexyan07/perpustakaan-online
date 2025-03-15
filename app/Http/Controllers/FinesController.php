<?php

namespace App\Http\Controllers;

use App\Models\Fines;
use App\Models\Peminjam;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FinesController extends Controller
{
    public function index(Request $request)
    {
        // peminjam telat mengembalikan buku
        $peminjamTelat = Peminjam::whereNull('tanggal_pengembalian')
            ->where('tenggat_pengembalian', '<', now())
            ->get();
        
        foreach ($peminjamTelat as $peminjam) {
            $daysLate = Carbon::parse($peminjam->tenggat_pengembalian)->diffInDays(Carbon::today());
            $denda = $daysLate * 5000;

            $existingFine = Fines::where('user_id', $peminjam->user_id)->where('alasan', 'Telat mengembalikan buku')->first();
            
            if($existingFine && $existingFine->status_pembayaran === 'belum dibayar' && $existingFine->jumlah < 100000) {
                $existingFine->jumlah = number_format($denda);
                $existingFine->save();
            }

            if(!$existingFine) {
                Fines::create([
                    'user_id' => $peminjam->user_id,
                    'book_id' => $peminjam->book_id,
                    'jumlah' => number_format($denda),
                    'status_pembayaran' => 'belum dibayar',
                    'alasan' => 'Telat mengembalikan buku',
                ]);
            }
        }

        $reservasiTidakDiambil = Reservations::where('expiration_date', '<=', now())->get();

        foreach ($reservasiTidakDiambil as $reservasi) {
            $existingFine = Fines::where('user_id', $reservasi->user_id)->where('alasan', 'Tidak mengambil buku yang sudah direservasi')->first();

            if(!$existingFine) {
                Fines::create([
                    'user_id' => $reservasi->user_id,
                    'book_id' => $reservasi->book_id,
                    'jumlah' => '5,000',
                    'status_pembayaran' => 'belum dibayar',
                    'alasan' => 'Tidak mengambil buku yang sudah direservasi',
                ]);
            }
        }
        
        $fines = Fines::with('user')->Filter(request(['keyword']))->orderByRaw("CASE WHEN status_pembayaran = 'dibayar' THEN 1 ELSE 0 END ASC")->paginate(20)->withQueryString();

        return view('admin.fines', ['fines' => $fines]);
    }

    public function dendaUser()
    {
        $finesIds = Auth::id();
        $fines = Fines::where('user_id', $finesIds)->where('status_pembayaran', 'belum dibayar')->get();
        return view('fines', ['fines' => $fines]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|max:255',
            'book' => 'required|max:255',
            'jumlah' => 'required|max:255',
            'status' => 'required|in:dibayar,belum dibayar'
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
            Fines::create([
                'user_id' => $request->user,
                'book_id' => $request->book,
                'jumlah'=> $request->jumlah,
                'status_pembayaran' => $request->status,
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
            'jumlah' => 'required|max:255',
            'status' => 'required|in:dibayar,belum dibayar'
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
            $fine = Fines::findOrFail($id);

            $fine->update([
                'user_id' => $request->user,
                'book_id' => $request->book,
                'jumlah'=> $request->jumlah,
                'status_pembayaran' => $request->status,
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Update');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $genre = Fines::findOrFail($id);
            $genre->delete();
            
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Hapus');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function fineClear($id)
    {
        $fine = Fines::findOrFail($id);
        $fine->status_pembayaran = 'dibayar';
        $fine->save();

        return redirect()->back()->with('status', 'success')->with('message', 'Denda dibayar');
    }
}
