<?php

namespace App\Http\Controllers;

use App\Models\peminjam;
use Carbon\Carbon;
use App\Models\barang;
use App\Models\fakultas;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use App\Models\lokasi_penyimpanan;
use Illuminate\Validation\Rules\Unique;

use function Termwind\render;

class barangController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('laboratorium')) {
            $laboratorium = laboratorium::firstWhere('slug', request('laboratorium'));
            $title = $laboratorium->nama_laboratorium;
        }
        return view('home', [
            "active" => '',
            "page" =>  $title,
            "namaBarang" => barang::where(
                [['status', 'tersedia'], ['kondisi', 'Bagus'],]
            )->select('nama_barang')->latest()->get(),

            "barangs" => barang::with(['laboratorium'])->where(
                [
                    ['status', 'tersedia'],
                    ['kondisi', 'Bagus'],
                ]
            )->latest()->filter(request(['search', 'laboratorium']))->groupby('nama_barang')->Paginate(50)->withQueryString(),

            "jumlahBarang" => barang::where(
                [['status', 'tersedia'], ['kondisi', 'Bagus'],]
            )->latest()->filter(request(['search', 'laboratorium']))->get()->groupBy('nama_barang')->map(function ($item) {
                return $item->count();
            }),

            "labs" => laboratorium::all(),
            "fakultases" => fakultas::with('jurusans')->get(),
        ]);
    }

    public function pinjamBarang()
    {
        $title = '';
        if (request('laboratorium')) {
            $laboratorium = laboratorium::firstWhere('slug', request('laboratorium'));
            $title = $laboratorium->nama_laboratorium;
        }
        return view('pinjamBarang', [
            "active" => '',
            "page" =>  $title,
            "namaBarang" => barang::where(
                [['status', 'tersedia'], ['kondisi', 'Bagus'],]
            )->select('nama_barang')->latest()->get(),

            "barangs" => barang::with(['laboratorium'])->where(
                [
                    ['status', 'tersedia'],
                    ['kondisi', 'Bagus'],
                ]
            )->latest()->filter(request(['search', 'laboratorium']))->groupby('nama_barang')->Paginate(50)->withQueryString(),

            "jumlahBarang" => barang::where(
                [['status', 'tersedia'], ['kondisi', 'Bagus'],]
            )->latest()->filter(request(['search', 'laboratorium']))->get()->groupBy('nama_barang')->map(function ($item) {
                return $item->count();
            }),

            "labs" => laboratorium::all(),
            "fakultases" => fakultas::with('jurusans')->get(),
        ]);
    }


    public function show(barang $barang)
    {

        return view('layout.singleBarang', [
            "active" => '',
            "page" => '',
            "jumlahBarang" => barang::where(
                [['nama_barang', $barang->nama_barang], ['status', 'Tersedia'], ['kondisi', 'Bagus'],]
            )->get()->count(),
            "barang" => $barang,
            "labs" => laboratorium::all(),
        ]);
    }
}
