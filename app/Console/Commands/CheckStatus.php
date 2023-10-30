<?php

namespace App\Console\Commands;

use App\Models\barang;
use App\Models\peminjam;
use App\Models\tanggungan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cek status pemesanan';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $peminjams = peminjam::where([['tanggal_kembali', '<', now()->toDateTimeString()], ['status', '!=', 'Selesai'],])->get();

        $peminjams->each(function (peminjam $peminjam) {
            if ($peminjam->barangs->contains('status', 'Dipinjamkan') || $peminjam->barangs->contains('status', 'Terlambat')) {
                $peminjam->status = 'Terlambat';
            } elseif ($peminjam->tanggungan) {
                $peminjam->status = 'Selesai*';
            } else {
                $peminjam->status = 'Selesai';
            }
            $peminjam->save();

            $peminjam->barangs->each(function (barang $barang,) {
                if ($barang->status == 'Dipinjamkan') {
                    $barang->status = 'Terlambat';
                    $validatedData['peminjam_id'] = $barang->peminjam_id;
                    $validatedData['kode_barang'] = $barang->kode_barang;
                    $validatedData['terlambat'] =  1;
                    tanggungan::create($validatedData);
                    $barang->save();
                    // echo 'idk';
                } elseif ($barang->status == 'Dikonfirmasi') {
                    $barang->peminjam_id = null;
                    $barang->status = 'Tersedia';
                    $barang->save();
                } elseif ($barang->status == 'Rusak') {
                    $barang->peminjam_id = null;
                    $barang->save();
                } elseif ($barang->status == 'Terlambat') {
                    if (tanggungan::where([['kode_barang', $barang->kode_barang], ['peminjam_id', $barang->peminjam_id], ['terlambat', '!=', null]])->get()->count()) {
                        tanggungan::where([['kode_barang', $barang->kode_barang], ['peminjam_id', $barang->peminjam_id], ['terlambat', '!=', null]])->increment('terlambat');
                    } else {
                        $validatedData['peminjam_id'] = $barang->peminjam_id;
                        $validatedData['kode_barang'] = $barang->kode_barang;
                        $validatedData['terlambat'] =  1;
                        tanggungan::create($validatedData);
                    }
                }
            });
        });
        $peminjams->each(function (peminjam $peminjam) {
            if ($peminjam->status == 'Terlambat') {
                $details = [
                    'nama' => $peminjam->nama_peminjam,
                    'barangs' => [$peminjam->barangs->where('status', 'Terlambat')->pluck('nama_barang')],
                ];

                Mail::to($peminjam->email_peminjam)->send(new \App\Mail\warningMail($details));
            }
        });
        // echo $details;
        // Log::info($barang->kode_barang);
    }
}
