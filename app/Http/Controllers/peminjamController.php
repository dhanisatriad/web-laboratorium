<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\User;
use App\Models\peminjam;
use App\Models\laboratorium;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Telegram\Bot\Laravel\Facades\Telegram;
use Cviebrock\EloquentSluggable\Services\SlugService;

class peminjamController extends Controller
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
        // $validatedData['file_name'] = $request->file('file_name')->store('post-surat');
        // dd($validatedData['file_name']);

        $rules = [
            'nama_peminjam' => 'required|max:255',
            'level' => 'required|max:255',
            'email_peminjam' => 'required|email|max:255',
            'nim' => 'required|max:255',
            'keperluan' => 'required|max:255',
            'kode_peminjaman' => 'required|unique:peminjams|max:255',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'kontak' => 'required',
            'tanggal_pinjam' => 'date|required',
            'tanggal_kembali' => 'date|required',
            'file_name' => 'required|file|max:2048|mimes:pdf,doc,docx',
            'barang' => 'required',
        ];

        if ($request->level == 'Mahasiswa') {
            $rules['dosen_pembimbing'] = 'required|max:255';
            $rules['nip_dosen'] = 'required|max:255';
            $validatedData['dosen_pembimbing'] = $request->dosen_pembimbing;
            $validatedData['nip_dosen'] = $request->nip_dosen;
        }

        $validatedData = $request->validate($rules);
        $validatedData['status'] = 'Sedang diProses';
        $validatedData['file_name'] = $request->file('file_name')->store('post-surat');
        $validatedData['tanggal_pinjam'] = date("Y-m-d", strtotime($request->tanggal_pinjam));
        $validatedData['tanggal_kembali'] = date("Y-m-d", strtotime($request->tanggal_kembali));


        $nama = $validatedData['nama_peminjam'];
        $nim = $validatedData['nim'];
        $level = $request->level;


        $details = [
                'suratIzin' =>  $validatedData['file_name'],
                'nama' => $nama,
                'nim' => $nim,
                'level' => $level
            ];

        Mail::to(user::where('level', 'admin')->latest()->pluck('email')[0])->send(new \App\Mail\laboratoriumEmail($details));


        $text = "<b>Pemesanan Barang Terbaru</b>\n"
            . "Status: $level\n"
            . "Atas Nama: $nama\n"
            . "NIP/NIK/NIM: $nim\n";
        Telegram::sendMessage([
            'chat_id' => '-731636577',
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        peminjam::create($validatedData);
        return  Redirect::to(url()->previous())->with('success', 'Permohonan anda telah berhasil dikirim! kode Peminjaman:' . $validatedData['kode_peminjaman']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peminjam  $peminjam
     * @return \Illuminate\Http\Response
     */
    public function show(peminjam $peminjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peminjam  $peminjam
     * @return \Illuminate\Http\Response
     */
    public function edit(peminjam $peminjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peminjam  $peminjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peminjam $peminjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peminjam  $peminjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(peminjam $peminjam)
    {
        //
    }


    public function cek()
    {



        return view('layout.cekpinjam', [
            "active" => '',
            "page" => '',
            "nims" => peminjam::latest()->filter(request(['nim']))->paginate(24)->withQueryString(),
            // "barangs" => ,
            "labs" => laboratorium::all(),
        ]);
    }

    public function checkSlug(Request $request)
    {
        $s = $request->nama_peminjam;
        $arr = preg_split('{[/ +/\-]}', $s);
        foreach ($arr as $key => $value) {

            preg_match_all('/\b([a-zA-Z_])/', strtoupper($arr[$key]), $m);
            $sing = implode('', $m[1]);
            $arr[$key] = $sing;
        }
        $sing = substr(implode('', $arr), 0, 15);
        $kode = SlugService::createSlug(peminjam::class, 'kode_peminjaman', $sing,);
        return response()->json(['kode' => $kode]);
    }



    public function pdfStream(Request $request)
    {
        // $url = Storage::path($request->nama_file);
        return Storage::download($request->nama_file);
    }
}
