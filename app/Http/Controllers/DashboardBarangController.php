<?php

namespace App\Http\Controllers;


use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Barang;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\lokasi_penyimpanan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Symfony\Contracts\Service\Attribute\Required;

class DashboardBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.dashboard.page.barang', [
            "title" => '',
            "show" => 'barang',
            "add" => '',
            "modals" => 'active',
            "barangs" => barang::with(['laboratorium', 'lokasi_penyimpanan'])->latest()->filter(request(['search', 'laboratorium', 'lokasi']))->paginate(50)->withQueryString(),
            "labs" => laboratorium::all(),
            "lokasis" => lokasi_penyimpanan::all()
        ]);
    }
    public function addRusak()
    {
        return view('layout.dashboard.page.dashboardAddRusak', [
            "show" => 'barang',
            "barangs" => barang::where('kondisi', 'Bagus')->where('status', 'Tersedia')->with(['laboratorium', 'lokasi_penyimpanan'])->latest()->filter(request(['search', 'laboratorium', 'lokasi']))->paginate(50)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // for duplicate exist barang
        $jumlah = $request->jumlah;
        if ($jumlah > 0) {
            self::duplicate($request);
            return  redirect('/dashboard/daftar-barang')->with('success',   $jumlah .  ' Barang berhasil ditambahkan');
        }


        // for duplicate new barang
        $request->merge(['kode_barang' => SlugService::createSlug(Barang::class, 'kode_barang', $request->kode_barang,)]);

        $validatedData = $request->validate([
            'nama_barang' => 'required|max:255',
            'laboratorium_id' => 'required',
            'kode_barang' => 'required|unique:barangs',
            'gambar_barang' => 'image|file|max:1024',
            'lokasi_penyimpanan_id' => 'required',
        ]);

        if ($request->file("gambar_barang")) {
            $validatedData["gambar_barang"] = $request->file("gambar_barang")->store('toPath', ['disk' => 'public']);
        }
        $validatedData['kondisi'] = 'Bagus';
        $validatedData['status'] = 'Tersedia';
        $validatedData['deskripsi'] = $request->deskripsi;
        $validatedData['part'] = $request->part;
        barang::create($validatedData);
        $jumlahb = $request->jumlahb - 1;
        if ($jumlahb > 0) {
            self::duplicate($request);
            return  Redirect::to(url()->previous())->with('success',    $request->jumlahb .  ' Barang berhasil ditambahkan');
        } else {
            return  Redirect::to(url()->previous())->with('success', 'Barang berhasil ditambahkan');
        }
    }


    private static function duplicate(Request $request)
    {
        if ($request->jumlahb > 0) {
            $jumlah = $request->jumlahb - 1;
        } else {
            $jumlah = $request->jumlah;
        }
        $kodeBarang = $request->kode_barang;
        $arr = preg_split('{[\-]}', $kodeBarang);   //bagi kode barang pada setiap "-"
        $last_key = array_key_last($arr);           //ambil key terakhir
        $lastValue = $arr[$last_key];               //ambil value dari key terakhir
        if (is_numeric($lastValue)) {
            $num = $lastValue;
        } else {
            $num = '';
        }
        if (is_numeric($arr[$last_key])) {
            array_pop($arr);
        }
        $sing = implode('-', $arr);                 //gabungkan kembali kode barang tampa value dari key terakhir
        for ($i = 1; $i <= $jumlah; $i++) {
            // $number = $num + $i;
            // if ($num == ''){
            $kbarang = $sing;
            // }
            // $number = str_pad($number, 2, '0', STR_PAD_LEFT); with 1
            // else{
            //     $kbarang = "$sing-$number";
            // }

            $val = new Request([
                'nama_barang' => $request->nama_barang,
                'laboratorium_id' => $request->laboratorium_id,
                'lokasi_penyimpanan_id' => $request->lokasi_penyimpanan_id,
                'kode_barang' =>   SlugService::createSlug(Barang::class, 'kode_barang', $kbarang,),
            ]);

            $validatedData = $val->validate([
                'nama_barang' => 'required|max:255',
                'laboratorium_id' => 'required',
                'lokasi_penyimpanan_id' => 'required',
                'kode_barang' => 'unique:barangs,kode_barang',
                'gambar_barang' => 'image|file|max:1024',
            ]);


            // $validatedData['slug'] = SlugService::createSlug(Barang::class, 'kode_barang', $kbarang,);

            if ($request->jumlahb > 0) {
                if ($request->file("gambar_barang")) {
                $validatedData["gambar_barang"] = $request->file("gambar_barang")->store('toPath', ['disk' => 'public']);
            }
            } else {
                $validatedData["gambar_barang"] = $request->gambar_barang;
            }
            $validatedData['status'] = 'Tersedia';
            $validatedData['deskripsi'] = $request->deskripsi;
            $validatedData['part'] = $request->part;
            $validatedData['kondisi'] = 'Bagus';


            // return $validatedData;
            barang::create($validatedData);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $daftar_barang)
    {
        return view('layout.dashboard.page.dashboardBarang', [
            "show" => 'barang',
            "labels" => '',
            "barang" => $daftar_barang,
            "jumlahBarang" => barang::where(
                'nama_barang', $daftar_barang->nama_barang
            )->get()->count(),
            "labs" => laboratorium::all(),
            "lokasis" => lokasi_penyimpanan::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
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
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Barang $daftar_barang)
    {
        // dd($request->old_image);
        $labId = $request->laboratorium_id;
        $kodeBarang = $request->kode_barang;

        $rules = [
            'nama_barang' => 'required|max:255',
            'kondisi' => 'required',
            'lokasi_penyimpanan_id' => 'required',
            'gambar_barang' => 'image|file|max:1024',
        ];


        if ($labId != $daftar_barang->laboratorium_id) {
            $newKode = self::migrasi($request, $kodeBarang);
            $val = new Request([
                'nama_barang' => $request->nama_barang,
                'kondisi' => $request->kondisi,
                'lokasi_penyimpanan_id' => $request->lokasi_penyimpanan_id,
                'laboratorium_id' => $newKode->laboratorium_id,
                'kode_barang' => $newKode->kode_barang,
            ]);
            $rules['laboratorium_id'] = 'required';
            $rules['kode_barang'] = 'required|unique:barangs';
            $request = $val;
        }
        $validatedData = $request->validate($rules);
        if ($kodeBarang != $daftar_barang->kode_barang) {
            $rules['kode_barang'] = 'required|unique:barangs';
            $kode_barang = SlugService::createSlug(Barang::class, 'kode_barang', $kodeBarang);
            // dd($kode_barang);
            $validatedData['kode_barang'] = $kode_barang;
        }
        if ($request->file("gambar_barang")) {
            if ($request->old_image !== null && Barang::where('gambar_barang', $request->old_image)->get('gambar_barang')->count() == 1) {
                // dd($request->old_image);
                Storage::disk('public')->delete($request->old_image);
            }
            $validatedData["gambar_barang"] = $request->file("gambar_barang")->store('toPath', ['disk' => 'public']);
        }
        if ($request->kondisi != 'Bagus') {
            $validatedData['kondisi'] = $request->kondisi;
            $validatedData['status'] = 'Rusak';
        } else {
            $validatedData['kondisi'] = $request->kondisi;
            $validatedData['status'] = 'Tersedia';
        }
        // dd($validatedData);
        barang::where('id', $daftar_barang->id)->update($validatedData);

        return Redirect::to(url()->previous())->with('success', 'Barang berhasil diedit');
    }

    public function migrateLabor(Request $request)
    {
        $nasis = Barang::where('laboratorium_id', $request->labAsal)->get();
        $test = $nasis->map(function ($barang) {
            return $barang->status;
        })->flatten();
        if ($test->contains('Terlambat') or $test->contains('Dipinjamkan') or $test->contains('Dikonfirmasi')) {
            return Redirect::to(url()->previous())->with('warning', 'Salah satu barang pada laboratorium sedang dipinjamkan');
        } else {
            foreach ($nasis as $nasi) {
                $kodeBarang = $nasi->kode_barang;
                $validatedData = self::migrasi($request, $kodeBarang)->validate([
                    'laboratorium_id' => 'required',
                    'kode_barang' => 'required|unique:barangs',
                ]);
                Barang::where('id', $nasi->id)->update($validatedData);
            }
            return Redirect::to(url()->previous())->with('success', 'Barang berhasil di Migrate');
        }
    }

    public function migrateLokasi(Request $request)
    {
        $nasis = Barang::where('lokasi_penyimpanan_id', $request->lokasiAsal)->get();
        $test = $nasis->map(function ($barang) {
            return $barang->status;
        })->flatten();
        if ($test->contains('Terlambat') or $test->contains('Dipinjamkan') or $test->contains('Dikonfirmasi')) {
            return Redirect::to(url()->previous())->with('warning', 'Salah satu barang pada laboratorium sedang dipinjamkan');
        } else {
            foreach ($nasis as $nasi) {
                $validatedData = $request->validate([
                    'lokasi_penyimpanan_id' => 'required',
                ]);
                Barang::where('id', $nasi->id)->update($validatedData);
            }
            return Redirect::to(url()->previous())->with('success', 'Barang berhasil di Migrate');
        }
    }

    public function migrateMultiLabor(Request $request)
    {
        $ids = $request->ids;
        $nasis = explode(",", $ids);
        foreach ($nasis as $id) {
            $nasi = Barang::where('id', $id)->first();
            if ($nasi->laboratorium_id != $request->laboratorium_id) {
                $kodeBarang = $nasi->kode_barang;
                $validatedData = self::migrasi($request, $kodeBarang)->validate([
                    'laboratorium_id' => 'required',
                    'kode_barang' => 'required|unique:barangs',
                ]);
                Barang::where('id', $id)->update($validatedData);
            }
        }
        $url = url()->previous();
        Session::flash('success', 'Barang Berhasil di Migrasi.');
        return response()->json(['success' => true, 'url' => $url]);
    }


    public function migrateMultiLokasi(Request $request)
    {
        $ids = $request->ids;
        $nasi = explode(",", $ids);
        foreach ($nasi as $id) {
            $validatedData = $request->validate([
                'lokasi_penyimpanan_id' => 'required',
            ]);
            // return $request->lokasi_penyimpanan_id;
            Barang::where('id', $id)->update($validatedData);
        }
        $url = url()->previous();
        Session::flash('success', 'Barang Berhasil di Migrasi.');
        return response()->json(['success' => true, 'url' => $url]);
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
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $daftar_barang)
    {
        if ($daftar_barang->gambar_barang !== null && Barang::where('gambar_barang', $daftar_barang->gambar_barang)->get('gambar_barang')->count() == 1) {
            Storage::disk('public')->delete($daftar_barang->gambar_barang);
        }
        Barang::destroy($daftar_barang->id);
        return Redirect::to(url()->previous())->with('success', 'Barang Berhasil dihapus');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $id = explode(",", $ids);
        foreach ($id as $idd) {
            $idk = Barang::where('id', $idd)->get('gambar_barang')->first();
            if ($idk->gambar_barang !== null && Barang::where('gambar_barang', $idk->gambar_barang)->get('gambar_barang')->count() == 1) {
                Storage::disk('public')->delete($idk->gambar_barang);
            }
            Barang::where('id', $idd)->delete();
        }
        $url = url()->previous();
        Session::flash('success',  'Barang Berhasil dihapus');
        return response()->json(['success' => true, 'url' => $url]);
    }




    public function printMulti(Request $request)
    {
        return view('printMulti', [
            "show" => 'barang',
            "barangs" => Barang::whereIn('id', explode(",", $request->ids))->latest()->get()
        ]);
    }


    // public function autocomplete(Request $request)

    // {
    //     $query = $request->get('str');
    //     $result=Barang::select('nama_barang')->where('nama_barang', 'LIKE', '%'. $query .'%')->get();
    //     return response()->json($result);

    // }



    public function createKodeBarang(Request $request)
    {
        if (is_null($request->nama_barang)) {
            $barang = '';
        } else {

            $s = $request->nama_barang;
            $arr = preg_split('{[/ +/\-]}', $s);
            $last_key = array_key_last($arr);
            $lastValue = $arr[$last_key];
            if (is_numeric($lastValue)) {
                $num = "-$lastValue";
            } else {
                // $num = '01'; with 1
                $num = '';
            }

            foreach ($arr as $key => $value) {
                if (is_numeric($arr[$key]) === false) {
                    preg_match_all('/\b([a-zA-Z_])/', strtoupper($arr[$key]), $m);
                    $sing = implode('', $m[1]);
                    $arr[$key] = $sing;
                }
            }
            if (is_numeric($arr[$last_key])) {
                array_pop($arr);
            }

            $sing = substr(implode('', $arr), 0, 15);

            $barang = "$sing$num";
        }
        if (is_null($request->laboratorium)) {
            $labor = '';
        } else {

            $a = $request->laboratorium;
            $labor = laboratorium::firstWhere('id', $a);
            $labor = $labor->kode_laboratorium;
        }

        $k = "$labor-$barang";
        $k = SlugService::createSlug(Barang::class, 'kode_barang', $k,);
        return response()->json(['success' => true, 'kode' => $k,]);
    }

    public function mutiCheckOut(Request $request)
    {
        $ids = $request->ids;
        $nasi = explode(",", $ids);
        foreach ($nasi as $id) {
            $validatedData['kondisi'] = 'Bagus';
            $validatedData['status'] = 'Tersedia';
            Barang::where('id', $id)->update($validatedData);
        }
        $url = url()->previous();
        Session::flash('success', 'Barang Berhasil di update.');
        return response()->json(['success' => true, 'url' => $url]);
        // $a = json_decode($request->kode_barang);
    }

    public function checkOut(Request $request)
    {
        $b = $request->check;
        if (Barang::where('status', 'Rusak')->get()->Contains('kode_barang', $b)) {
            $validatedData['kondisi'] = 'Bagus';
            $validatedData['status'] = 'Tersedia';
            Barang::where('kode_barang', $b)->update($validatedData);
            return response()->json(['success' => true, 'kode' => $b,]);
        }
    }



    public function mutiCheckIn(Request $request)
    {
        // dd($request);
        $ids = $request->ids;
        $nasi = explode(",", $ids);
        foreach ($nasi as $id) {
            $validatedData['kondisi'] = $request->kondisi;
            $validatedData['status'] = 'Rusak';
            Barang::where('id', $id)->update($validatedData);
        }
        return redirect('/dashboard/barang-rusak')->with('success',   $request->jumlah .  ' Barang berhasil ditambahkan');
    }

    public function checkInRusak(Request $request)
    {
        $b = $request->check;
        if (Barang::get()->Contains('kode_barang', $b)) {
            return response()->json(['success' => true, 'kode' => $b,]);
        }
    }

    public function konfirmasiRusak(Request $request)
    {
        $barangs = json_decode($request->barangs);
        foreach ($barangs as $barang) {
            $validatedData['kondisi'] = $barang[1];
            $validatedData['status'] = 'Rusak';
            Barang::where('kode_barang', $barang[0])->update($validatedData);
        }
        $url = url()->previous();
        Session::flash('success', 'Barang Berhasil di update.');
        return response()->json(['success' => true, 'url' => $url,]);
    }
}
