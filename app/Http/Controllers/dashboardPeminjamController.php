<?php

namespace App\Http\Controllers;


use App\Models\barang;
use App\Models\peminjam;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\lokasi_penyimpanan;
use App\Models\tanggungan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\IsTrue;

class dashboardPeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.dashboard.page.dashboardDaftarPermohonan', [
            "show" => 'client',
            "label" => '',
            "permohonans" => peminjam::latest()->paginate(50)->withQueryString(),
        ]);
    }

    public function permohonan()
    {

        return view('layout.dashboard.page.dashboardDaftarPermohonan', [
            "show" => 'client',
            "label" => '',
            "permohonans" => peminjam::where('status', 'Sedang diProses')->latest()->filter(request(['search', 'laboratorium']))->paginate(50)->withQueryString(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(peminjam $daftar_client)
    {
        // dd($daftar_client);
        $semuaBarang = json_decode($daftar_client->barang, true);
        $flattened = collect($semuaBarang)->groupBy('barang')->flatMap(function ($items) {
            $quantity = $items->sum('jumlah');
            return $items->map(function ($item) use ($quantity) {
                $item["jumlah"] = $quantity;
                return $item;
            });
        });
        $coll = $flattened->unique('barang');

        $collection = collect([]);
        foreach ($coll as $barang) {
            $a = array();
            $barang = collect($barang);
            $a[] = $barang->get('barang');
            $b =  $barang->get('jumlah');
            $barangs = barang::whereIn('nama_barang', $a)->where('status', 'tersedia')->take($b)->with(['laboratorium', 'lokasi_penyimpanan'])->latest()->get();
            $collection = $collection->merge($barangs);
        }
        // dd($collection);
        return view('layout.dashboard.page.dashboardCekSurat', [
            "show" => 'client',
            "barangs" => $collection,
            "peminjam" => $daftar_client,
            "tanggungans" => tanggungan::where('peminjam_id', $daftar_client->id)->latest()->get(),
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function scan()
    {
        return view('layout.dashboard.page.dashboardScan', [
            "show" => 'barang',
            "label" => '',
            "permohonans" => peminjam::latest()->get(),
        ]);
    }


    public function konfirmasi(Request $request)
    {
        $a = [];
        $ids = $request->ids;
        $nasi = explode(",", $ids);
        foreach ($nasi as $id) {
            $validatedData = $request->validate([
                'peminjam_id' => 'required',
                'status' => 'required'
            ]);
            $validatedData['peminjam_id'] = $request->peminjam_id;
            Barang::where('id', $id)->update($validatedData);
            $b = Barang::where('id', $id)->pluck('nama_barang')->toArray();
            $c = implode(" ", $b);
            array_push($a, $c);
        }
        $validatedData2 = $request->validate([
            'status' => 'required',
        ]);
        peminjam::where('id', $request->peminjam_id)->update($validatedData2);


        $details = [
            'nama' => $request->nama_peminjam,
        ];

        Mail::to($request->email_peminjam)->send(new \App\Mail\konfirmasiMail($details));

        return  redirect('/dashboard/daftar-client')->with('success', 'Permohonan peminjaman berhasil dikonfirmasi');
    }

    public function tolak(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'status' => 'required',
        ]);
        peminjam::where('id', $request->peminjam_id)->update($validatedData);

        return  redirect('/dashboard/daftar-client')->with('success', 'Permohonan peminjaman berhasil ditolak');
    }

    public function checkOut(Request $request)
    {
        $a = json_decode($request->kode_barang);
        $b = $request->check;
        if (in_array($b, $a)) {
            $validatedData['status'] = 'Dipinjamkan';
            Barang::where('kode_barang', $b)->update($validatedData);
            $c =  $b;
            return response()->json(['success' => true, 'kode' => $c,]);
        } else {
            $c = "not found";
            return response()->json(['success' => false, 'kode' => $c,]);
        }
    }

    public function checkIn(Request $request)
    {
        $a = json_decode($request->kode_barang);
        $b = $request->check;
        if (in_array($b, $a)) {
            return response()->json(['success' => true, 'kode' => $b,]);
        } else {
            return response()->json(['success' => false,]);
        }
    }

    public function checkInKonfirmasi(Request $request)
    {
        $barangs = json_decode($request->barangs);
        if ($request->status == 'Dikonfirmasi') {
            foreach ($barangs as $barang) {
                if ($barang[1] == 'Rusak' || $barang[1] == 'Rusak Ringan') {
                    $validatedData['kondisi'] = $barang[1];
                    $validatedData['status'] = 'Rusak';
                    $validatedData['peminjam_id'] = null;
                    Barang::where('kode_barang', $barang[0])->update($validatedData);
                    if (tanggungan::where([['kode_barang', $barang[0]], ['peminjam_id', $request->id_peminjam]])->get()->count()) {
                        $validatedData2['kondisi'] = $barang[1];
                        tanggungan::where([['kode_barang', $barang[0]], ['peminjam_id', $request->id_peminjam]])->update($validatedData2);
                    } else {
                        $validatedData2['peminjam_id'] = $request->id_peminjam;
                        $validatedData2['kode_barang'] = $barang[0];
                        $validatedData2['kondisi'] = $barang[1];
                        tanggungan::create($validatedData2);
                    };
                } elseif ($barang[1] == 'Bagus') {
                    $validatedData['kondisi'] = $barang[1];
                    $validatedData['status'] = 'Dikonfirmasi';
                    Barang::where('kode_barang', $barang[0])->update($validatedData);
                }
            }
        } elseif ($request->status == 'Terlambat') {
            foreach ($barangs as $barang) {
                if ($barang[1] == 'Rusak' || $barang[1] == 'Rusak Ringan') {
                    $validatedData['kondisi'] = $barang[1];
                    $validatedData['status'] = 'Rusak';
                    $validatedData['peminjam_id'] = null;
                    Barang::where('kode_barang', $barang[0])->update($validatedData);
                    if (tanggungan::where([['kode_barang', $barang[0]], ['peminjam_id', $request->id_peminjam]])->get()->count()) {
                        $validatedData2['kondisi'] = $barang[1];
                        tanggungan::where('kode_barang', $barang[0])->update($validatedData2);
                    } else {
                        $validatedData2['peminjam_id'] = $request->id_peminjam;
                        $validatedData2['kode_barang'] = $barang[0];
                        $validatedData2['kondisi'] = $barang[1];
                        tanggungan::create($validatedData2);
                    };
                } elseif ($barang[1] == 'Bagus') {
                    $validatedData['kondisi'] = $barang[1];
                    $validatedData['status'] = 'Tersedia';
                    $validatedData['peminjam_id'] = null;
                    Barang::where('kode_barang', $barang[0])->update($validatedData);
                }
            }
            if (Barang::get()->doesntContain('peminjam_id', $request->id_peminjam)) {
                $validatedData3['status'] = 'Selesai*';
                peminjam::where('id', $request->id_peminjam)->update($validatedData3);
            }
        }
        $url = url()->previous();
        Session::flash('success', 'Barang berhasil dikembalikan');
        return response()->json(['success' => true, 'url' => $url,]);
    }

    public function checkNim(Request $request)
    {
        // dd($request);
        return view('layout.dashboard.page.dashboardDaftarPermohonan', [
            "show" => 'client',
            "label" => '',
            "permohonans" => peminjam::where('nim', $request->nim)->latest()->paginate(50)->withQueryString(),
        ]);
    }


    public function pdfStream(Request $request)
    {
        // $url = Storage::path($request->nama_file);
        return Storage::download($request->nama_file);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $url = url()->previous();
        $file = peminjam::where('id', $id)->first()->file_name;
        Storage::delete($file);
        tanggungan::where('peminjam_id', $id)->delete();
        peminjam::where('id', $id)->delete();
        Session::flash('success', "Permohonan Berhasil di hapus.");
        return response()->json(['success' => true, 'url' => $url, 'success' => "Permohonan Berhasil di hapus."]);
    }

    public function deleteTanggunan(Request $request)
    {
        // dd(peminjam::where('id', $request->id)->pluck('status')[0]);
        tanggungan::where('peminjam_id', $request->id)->delete();
        if (peminjam::where('id', $request->id)->pluck('status')[0] == 'Selesai*') {
            $validatedData['status'] = 'Selesai';
            peminjam::where('id', $request->id)->update($validatedData);
        }
        return Redirect::to(url()->previous())->with('success', 'Tanggungan Berhasil di hapus.');
    }
}
