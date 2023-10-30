<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\peminjam;
use App\Models\laboratorium;
use App\Models\lokasi_penyimpanan;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function index()
    {
        return view('layout.dashboard.page.index', [
            "show" => '',
            "jumBarang" => barang::count(),
            "jumLabor" => laboratorium::count(),
            "jumRuang" => lokasi_penyimpanan::count(),
            "jumBarangRusak" => barang::where('kondisi', 'Rusak')->count(),
            "jumClient" => peminjam::count(),
            "jumBarangDipinjam" => barang::where('status', 'Dipinjamkan')->orWhere('status', 'Terlambat')->count(),
            "permohonans" => peminjam::where('status', 'Sedang diProses')->latest()->get()->take(5)
        ]);
    }

    public function checkView()
    {
        return view('layout.dashboard.page.dashboardCheckInOut', [
            "show" => 'client',
        ]);
    }



    public function barangRusak()
    {
        return view('layout.dashboard.page.barang', [
            "title" => 'Rusak',
            "show" => 'barang',
            "add" => '',
            "modals" => 'active',
            "barangs" => barang::where('kondisi' ,'!=', 'Bagus')->with(['laboratorium', 'lokasi_penyimpanan'])->latest()->filter(request(['search', 'laboratorium', 'lokasi']))->paginate(50)->withQueryString(),
            "labs" => laboratorium::all(),
            "lokasis" => lokasi_penyimpanan::all()
        ]);
    }

    public function barangDipinjam()
    {
        return view('layout.dashboard.page.dashboardBarangPinjam', [
            "show" => 'barang',
            "add" => '',
            "modals" => 'active',
            "labs" => laboratorium::all(),
            "lokasis" => lokasi_penyimpanan::all(),
            "barangs" => barang::where('status', 'Dipinjamkan')->orWhere('status', 'Terlambat')->with(['laboratorium', 'lokasi_penyimpanan'])->latest()->filter(request(['search', 'laboratorium', 'lokasi']))->paginate(50)->withQueryString(),
        ]);
    }


    public function DaftarLaboratorium()
    {
        return view('layout.dashboard.page.DashboardLab', [

            "show" => 'barang',

            "labs" => laboratorium::with(['barangs'])->get(),
        ]);
    }

    public function DaftarLokasi()
    {
        return view('layout.dashboard.page.DashboardLokasi', [

            "show" => 'barang',

            "lokasis" => lokasi_penyimpanan::with(['barangs'])->get(),
        ]);
    }
}
