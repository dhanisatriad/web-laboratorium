<?php

namespace App\Http\Controllers;
use App\Models\barang;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class singleBarang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Barang $barang)
    {
        $labId = $request->laboratorium_id;
        $kodeBarang = $request->kode_barang;

        $rules = [
            'nama_barang' => 'required|max:255',
            'kondisi' => 'required',
            'lokasi_penyimpanan_id' => 'required',
            'gambar_barang' => 'image|file|max:1024',
        ];

        if ($labId != $barang->laboratorium_id) {
            $newKode = self::migrasi($request, $kodeBarang);
            $val = new Request([
                'nama_barang' => $request->nama_barang,
                'kondisi' => $request->kondisi,
                'lokasi_penyimpanan_id' => $request->lokasi_penyimpanan_id,
                'deskripsi' => $request->deskripsi,
                'part' => $request->part,
                'laboratorium_id' => $newKode->laboratorium_id,
                'kode_barang' => $newKode->kode_barang,
            ]);
            $rules['laboratorium_id'] = 'required';
            $rules['kode_barang'] = 'required|unique:barangs';
            $request = $val;
        }
        $validatedData = $request->validate($rules);
        if ($kodeBarang != $barang->kode_barang) {
            $rules['kode_barang'] = 'required|unique:barangs';
            $kode_barang = SlugService::createSlug(Barang::class, 'kode_barang', $kodeBarang);
            $validatedData['kode_barang'] = $kode_barang;
        }
        $validatedData['deskripsi'] = $request->deskripsi;
        $validatedData['part'] = $request->part;
        if ($request->file("gambar_barang")) {
            if ($request->old_image !== null && Barang::where('gambar_barang', $request->old_image)->get('gambar_barang')->count() == 1) {
                Storage::disk('public')->delete($request->old_image);
            }
            $validatedData["gambar_barang"] = $request->file("gambar_barang")->store('toPath', ['disk' => 'public']);
        }
        if ($request->hapus_gambar_input) {
            if ($request->old_image !== null && Barang::where('gambar_barang', $request->old_image)->get('gambar_barang')->count() == 1) {
                Storage::disk('public')->delete($request->old_image);
            }
            $validatedData["gambar_barang"] = null;
        }
        if ($request->kondisi != 'Bagus') {
            $validatedData['kondisi'] = $request->kondisi;
            $validatedData['status'] = 'Rusak';
        } else {
            $validatedData['kondisi'] = $request->kondisi;
            $validatedData['status'] = 'Tersedia';
        }


        barang::where('id', $barang->id)->update($validatedData);
        return redirect('/dashboard/daftar-barang/'.$kodeBarang)->with('success', 'Barang berhasil diedit');

    }

    private static function migrasi(Request $request, $kodeBarang)
    {
        // return $request->labTujuan;
        $arr = preg_split('{[\-]}', $kodeBarang);   //bagi kode barang pada setiap "-"
        array_shift($arr);
        $labt = laboratorium::where('id', $request->laboratorium_id)->first();
        $num = implode('-', $arr);
        $kod = $labt->kode_laboratorium;
        $kode_barang = "$kod-$num";
        $kode = SlugService::createSlug(Barang::class, 'kode_barang', $kode_barang);
        $val = new Request([
            'laboratorium_id' => $request->laboratorium_id,
            'kode_barang' => $kode
        ]);
        return $val;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        if ($barang->gambar_barang !== null && Barang::where('gambar_barang', $barang->gambar_barang)->get('gambar_barang')->count() == 1) {
            Storage::disk('public')->delete($barang->gambar_barang);
        }
        Barang::destroy($barang->id);

        return Redirect('/dashboard/daftar-barang/')->with('success', 'Barang Berhasil dihapus');
        // return $barang;
    }

    public function hapusGambar(barang $barang)
    {
        if ($barang->gambar_barang !== null && Barang::where('gambar_barang', $barang->gambar_barang)->get('gambar_barang')->count() == 1) {
            Storage::disk('public')->delete($barang->gambar_barang);
        }
    }


    public function cetak_pdf(Request $request)
    {
    	return view('printMulti', [
            "show" => 'barang',
            "barangs" => Barang::whereIn('id', explode(",", $request->id))->latest()->get()
        ]);
    }
    // public function cetak_pdf(Request $request)
    // {
    // 	$barang = barang::where('id', $request->id)->first();
    // 	$pdf = Pdf::loadview('print',['barang' => $barang]);
    // 	return $pdf->stream();
    // }
}
