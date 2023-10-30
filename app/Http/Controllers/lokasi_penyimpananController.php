<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use App\Models\lokasi_penyimpanan;
use Illuminate\Support\Facades\Redirect;

class lokasi_penyimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.dashboard.page.DashboardLokasi', [
            "show" => 'barang',
            "label" => '',
            "lokasis" => lokasi_penyimpanan::with(['barangs'])->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|max:255',
            'kode_lokasi' => 'required|unique:lokasi_penyimpanans',
            'deskripsi' => ''
        ]);
        $validatedData['slug'] = $request->kode_lokasi;
        lokasi_penyimpanan::create($validatedData);
        return  Redirect::to(url()->previous())->with('success', 'Ruang penyimpanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lokasi_penyimpanan  $lokasi_penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function show(lokasi_penyimpanan $lokasi_penyimpanan)
    {
        return view('layout.dashboard.page.barang', [
            "title" => '',
            "show" => 'barang',
            "add" => 'dafRuang',
            "modals" => 'active',
            "labels" => $lokasi_penyimpanan,
            "barangs" => barang::where('lokasi_penyimpanan_id',$lokasi_penyimpanan->id)->with(['lokasi_penyimpanan', 'laboratorium'])->latest()->filter(request(['search', 'laboratorium', 'lokasi']))->paginate(50)->withQueryString(),
            "labs" => laboratorium::all(),
            "lokasis" => lokasi_penyimpanan::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lokasi_penyimpanan  $lokasi_penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(lokasi_penyimpanan $lokasi_penyimpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lokasi_penyimpanan  $lokasi_penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lokasi_penyimpanan $lokasi_penyimpanan)
    {
        $kodeLokasi = $request->kode_laboratorium;

        $rules = [
            'nama_lokasi' => 'required|max:255',
        ];

        if ($kodeLokasi != $lokasi_penyimpanan->kode_lokasi) {
            $rules['kode_lokasi'] = 'required|unique:lokasi_penyimpanans';
            $validatedData['kode_lokasi'] = $kodeLokasi;
            $validatedData['slug'] = $kodeLokasi;
        }
        $validatedData = $request->validate($rules);

        lokasi_penyimpanan::where('id', $lokasi_penyimpanan->id)
            ->update($validatedData);

            return Redirect::to(url()->previous())->with('success', 'Ruang Penyimpanan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lokasi_penyimpanan  $lokasi_penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(lokasi_penyimpanan $lokasi_penyimpanan)
    {
        lokasi_penyimpanan::destroy($lokasi_penyimpanan->id);

        return Redirect::to(url()->previous())->with('success', 'Ruang Penyimpanan Berhasil dihapus');
    }
}
