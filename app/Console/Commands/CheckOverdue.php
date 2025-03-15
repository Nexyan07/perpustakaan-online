<?php

namespace App\Console\Commands;

use App\Models\Fines;
use App\Models\Peminjam;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class CheckOverdue extends Command
{
    protected $signature = 'fines:check';
    protected $description = 'Cek peminjaman yang sudah lewat tenggat waktu';

    public function handle()
    {
        $peminjamTelat = Peminjam::whereNull('tanggal_pengembalian')
            ->where('tenggat_pengembalian', '<', now())
            ->get();
        
        foreach ($peminjamTelat as $peminjam) {
            $daysLate = Carbon::parse($peminjam->tenggat_pengembalian)->diffInDays(Carbon::today());
            $denda = $daysLate * 5000;

            $existingFine = Fines::where('peminjam_id', $peminjam->id)->first();
            
            if($existingFine && $existingFine->status_pembayaran === 'belum dibayar') {
                $existingFine->jumlah = number_format($denda);
                $existingFine->save();
            }

            if(!$existingFine) {
                Fines::create([
                    'peminjam_id' => $peminjam->id,
                    'book_id' => $peminjam->book_id,
                    'jumlah' => number_format($denda),
                    'status_pembayaran' => 'belum dibayar',
                ]);
            }

        }

        $this->info('Pengecekan peminjaman yang sudah lewat tenggat waktu selesai');
    }
}
