<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use App\Models\lokasi_penyimpanan;
use Illuminate\Support\Facades\Redirect;

class laboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.dashboard.page.DashboardLab', [

            "show" => 'barang',
            "label" => '',
            "labs" => laboratorium::with(['barangs'])->latest()->get(),
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
            'nama_laboratorium' => 'required|max:255',
            'kode_laboratorium' => 'required|unique:laboratoria',
        ]);
        $validatedData['slug'] = $request->kode_laboratorium;
        laboratorium::create($validatedData);
        return  Redirect::to(url()->previous())->with('success', 'Laboratorium berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(laboratorium $daftar_laboratorium)
    {

        return view('layout.dashboard.page.barang', [
            "title" => '',
            "show" => 'barang',
            "add" => 'daflab',
            "modals" => 'active',
            "labels" => $daftar_laboratorium,
            "barangs" => barang::where('laboratorium_id',$daftar_laboratorium->id)->with(['laboratorium','lokasi_penyimpanan'])->latest()->filter(request(['search', 'laboratorium', 'lokasi']))->paginate(50)->withQueryString(),
            "labs" => laboratorium::all(),
            "lokasis" => lokasi_penyimpanan::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, laboratorium $daftar_laboratorium)
    {
        $kodeLaboratorium = $request->kode_laboratorium;

        $rules = [
            'nama_laboratorium' => 'required|max:255',
        ];

        if ($kodeLaboratorium != $daftar_laboratorium->kode_laboratorium) {
            $rules['kode_laboratorium'] = 'required|unique:laboratoria';
            $validatedData['kode_laboratorium'] = $kodeLaboratorium;
            $validatedData['slug'] = $kodeLaboratorium;
        }
        $validatedData = $request->validate($rules);

        laboratorium::where('id', $daftar_laboratorium->id)
            ->update($validatedData);

            return Redirect::to(url()->previous())->with('success', 'Laboratorium berhasil diedit');
    //    return $daftar_laboratorium;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(laboratorium $daftar_laboratorium)
    {
        laboratorium::destroy($daftar_laboratorium->id);

        return Redirect::to(url()->previous())->with('success', 'Laboratorium Berhasil dihapus');
    }
}
