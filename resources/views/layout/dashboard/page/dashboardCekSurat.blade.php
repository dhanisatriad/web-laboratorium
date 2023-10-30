@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div id="serah" class="container-fluid px-4 mb-5">
                @if (session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    {!! implode(
                        '',
                        $errors->all(' <div class="alert alert-danger alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>'),
                    ) !!}
                @endif
                <div id="serah2" class="card my-4   shadow">
                    <div
                        class="card-header text-white fw-bold fs-4 @if ($peminjam->status == 'Terlambat' || $peminjam->status == 'Selesai*') {{ 'bg-danger' }}
                        @else
                        {{ 'bg-primary' }} @endif">
                        <i class="fas fa-table me-1"></i>
                        Data Permohonan
                    </div>

                    <div class="card-body table-responsive">
                        <div class=" mb-3">
                            <a  href="" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#help"><i
                                    class="fa-solid fa-circle-question"></i> Help</a>
                        </div>
                        <div class="row">
                            <div class="col-xl-8 col-lg-12 mb-4">
                                <div class="card shadow">
                                    <div
                                        class="card-header text-light fs-5 fw-bold  mb-1  @if ($peminjam->status == 'Terlambat' || $peminjam->status == 'Selesai*') {{ 'bg-danger' }}
                                        @else
                                        {{ 'bg-primary' }} @endif">
                                        Status Permohonan : {{ $peminjam->status }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-1">
                                            <div class="col-xl-6 col-lg-12 table-responsive">
                                                <table
                                                    class="table table-sm table-hover table-striped  rounded rounded-4 overflow-hidden">
                                                    <tbody>
                                                        {{-- <tr>
                                                                <th>Status Permohonan :</th>
                                                                <td>{{ $peminjam->status }}</td>
                                                            </tr> --}}
                                                        <tr>
                                                            <th>Keperluan : </th>
                                                            <td>{{ $peminjam->keperluan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status : </th>
                                                            <td>{{ $peminjam->level }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama : </th>
                                                            <td>{{ $peminjam->nama_peminjam }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email : </th>
                                                            <td>{{ $peminjam->email_peminjam }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM/NIK :</th>
                                                            <td>{{ $peminjam->nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Fakultas :</th>
                                                            <td>{{ $peminjam->fakultas }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Prodi :</th>
                                                            <td>{{ $peminjam->jurusan }}</td>
                                                        </tr>
                                                        @if ($peminjam->level == 'Mahasiswa')
                                                            <tr>
                                                                <th>Dosen Pembimbing :</th>
                                                                <td>{{ $peminjam->dosen_pembimbing }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>NIP/NIK Dosen :</th>
                                                                <td>{{ $peminjam->nip_dosen }}</td>
                                                            </tr>
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-xl-6 col-md-12 table-responsive">
                                                <table
                                                    class="table  table-sm table-hover table-striped  rounded rounded-4 overflow-hidden">
                                                    @php
                                                        $nasi = json_decode($peminjam->barang, true);
                                                        // dd($peminjam);
                                                    @endphp
                                                    <tbody>
                                                        <tr>
                                                            <th>Kode Peminjaman :</th>
                                                            <td>{{ $peminjam->kode_peminjaman }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Peminjaman : </th>
                                                            <td>{{ date('d-m-Y', strtotime($peminjam->tanggal_pinjam)) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pengembalian :</th>
                                                            <td>{{ date('d-m-Y', strtotime($peminjam->tanggal_kembali)) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>File Surat Izin :</th>
                                                            <td> <a href="/dashboard/daftar-client/file?nama_file={{ $peminjam->file_name }}"
                                                                    target="_blank">File Surat</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Barang:</th>

                                                            <td>
                                                                @foreach ($nasi as $namabarang)
                                                                    @php
                                                                        $barang = collect($namabarang);
                                                                        $b = $barang->get('barang');
                                                                        $j = $barang->get('jumlah');
                                                                    @endphp
                                                                    <a class="text-decoration-none text-black text-break"
                                                                        href="/dashboard/daftar-barang?search={{ $b }}">{{ $b }}
                                                                        {{ ' X ' . $j }} <br>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($tanggungans->count())
                                <div class="col-xl-4 col-lg-12 mb-4">
                                    <div class="card shadow">
                                        <div class="card-header bg-danger fw-bold text-white">
                                            Tanggungan!
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table
                                                class="table table-danger shadow table-sm rounded rounded-4 overflow-hidden">
                                                <tbody>
                                                    @foreach ($tanggungans as $tanggungan)
                                                        <tr>
                                                            <td>
                                                                kode barang: <a
                                                                    class=" fw-bold text-decoration-none text-black"
                                                                    href="{{ route('daftar-barang.show', $tanggungan->kode_barang) }}">{{ $tanggungan->kode_barang }}</a>
                                                                <b></b>
                                                                <br>
                                                                @if ($tanggungan->terlambat != null)
                                                                    Terlambat dikembalikan:
                                                                    {{ $tanggungan->terlambat }}
                                                                    hari
                                                                    <br>
                                                                @endif
                                                                @if ($tanggungan->kondisi != null)
                                                                    Dikembalikan dalam kondsi:
                                                                    {{ $tanggungan->kondisi }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm btn-danger m-1" data-bs-toggle="modal"
                                                data-bs-target="#hapusT"><i class="fa-solid fa-trash"></i> Hapus
                                                Tanggungan</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="hapusT" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-light">
                                                <h5 class="modal-title" id="staticBackdropLabel">Hapus Tangungan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Hapus Tanggungan {{ $peminjam->nama_peminjam }}?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>

                                                <form action="{{ route('deleteTanggunan', $peminjam->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $peminjam->id }}"
                                                        readonly>
                                                    <button class="btn bg-danger" id="hapus">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>


                        {{-- @php
                            // dd($barangs);
                        @endphp --}}
                        @if ($peminjam->status == 'Sedang diProses')
                            @if ($barangs->count())
                                @if (auth()->user()->level == 'Admin')
                                    <input type="checkbox" class="btn-check" id="master" autocomplete="off">
                                    <label class="btn btn-primary m-1" for="master">select all</label>
                                    <button class="btn btn-success konfirmasi m-1">Konfirmasi</button>
                                    <button class="btn btn-danger tolak m-1">Tolak</button>
                                @endif
                            @endif
                        @elseif($peminjam->status == 'Dikonfirmasi' || $peminjam->status == 'Terlambat')
                            @if ($peminjam->barangs->count())
                                <button class="btn btn-primary {{ $peminjam->status == 'Terlambat' ? 'disabled' : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#cek2"><i
                                        class="fa-solid fa-square-caret-up"></i>
                                    Peminjaman Barang</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cekIn2"><i
                                        class="fa-solid fa-square-caret-up"></i>
                                    Pengambalian Barang</button>
                            @endif
                        @endif

                        @php
                            if ($peminjam->status == 'Sedang diProses') {
                                $barangs = $barangs;
                            } else {
                                $barangs = $peminjam->barangs;
                                // dd($barangs);
                            }
                            // dd($barangs)
                        @endphp
                        @if ($barangs->count())
                            <table id="datatablesSimple"
                                class="table dataTable-table table-hover table-striped mt-2 shadow rounded rounded-4 overflow-hidden">

                                <thead class="bg-primary fs-6">
                                    <tr class="text-white text-center">
                                        @if ($peminjam->status == 'Sedang diProses')
                                            <th>Select</th>
                                        @endif
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Milik lab</th>
                                        <th>Lokasi Penyimpanan</th>
                                        <th>Kondisi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr class="text-center">
                                            @if ($peminjam->status == 'Sedang diProses')
                                                <td><input type="checkbox" class="sub_chk" data-id="{{ $barang->id }}">
                                            @endif
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a class="text-decoration-none text-black text-break"
                                                    href="{{ route('daftar-barang.show', $barang->kode_barang) }}">{{ $barang->nama_barang }}</a>
                                            </td>
                                            <td><a class="text-decoration-none text-black text-break"
                                                    href="{{ route('daftar-barang.show', $barang->kode_barang) }}">{{ $barang->kode_barang }}</a>
                                            </td>
                                            <td><a class="text-decoration-none text-black"
                                                    href="{{ route('daftar-laboratorium.show', $barang->laboratorium->kode_laboratorium) }}">{{ $barang->laboratorium->nama_laboratorium }}</a>
                                            </td>
                                            <td><a class="text-decoration-none text-black"
                                                    href="{{ route('lokasi-penyimpanan.show', $barang->lokasi_penyimpanan->kode_lokasi) }}">{{ $barang->lokasi_penyimpanan->nama_lokasi }}</a>
                                            </td>
                                            <td>{{ $barang->kondisi }}</td>
                                            <td class="@if ($barang->status == 'Rusak' || $barang->status == 'Terlambat') {{ 'bg-danger' }}
                                                @elseif ($barang->status == 'Dipinjamkan')
                                                {{ 'bg-success text-white' }} @endif
                                                "
                                                data-status="{{ $barang->kode_barang }}">{{ $barang->status }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            @if ($peminjam->status == 'Sedang diProses')
                            @if (auth()->user()->level == 'Admin')
                            <button class="btn btn-danger tolak m-1">Tolak</button>
                            @endif
                                <p class="text-center fs-4">Barang kosong</p>
                            @endif
                        @endif
                    </div>
                </div>

                @if (auth()->user()->level == 'Admin')
                    <div class="modal fade" id="modalyakin" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Peminjaman</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="Jkonfirmasi">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form method="POST" action="{{ route('konfirmasi') }}">
                                        @csrf
                                        <input type="hidden" name="ids" id="konfirmasiId" readonly>
                                        <input type="hidden" name="nama_peminjam" id="nama_peminjam"
                                            value="{{ $peminjam->nama_peminjam }}" readonly>
                                        <input type="hidden" name="email_peminjam" id="email_peminjam"
                                            value="{{ $peminjam->email_peminjam }}" readonly>
                                        <input type="hidden" name="peminjam_id" value="{{ $peminjam->id }}" readonly>
                                        <input type="hidden" name="status" value="Dikonfirmasi" readonly>
                                        <button class="btn btn-primary">Konfirmasi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="exampleModalLabel2"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="exampleModalLabel2">Konfirmasi Penolakan Permohonan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="nasi">
                                    Apakah anda yakin untuk menolak permohonan peminjaman barang?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form method="POST" action="{{ route('tolak') }}">
                                        @csrf
                                        <input type="hidden" name="peminjam_id" value="{{ $peminjam->id }}">
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button class="btn btn-danger">Tolak</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            @if ($peminjam->status == 'Dikonfirmasi' || $peminjam->status == 'Terlambat')
                @if ($peminjam->barangs->count())
                    <div class="modal fade" id="cek2" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h5 class="modal-title">Peminjaman Barang</h5>
                                    <button type="button" class="btn-close" id="tutupCek2"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="content">
                                        <input type="hidden" class="form-control" id="jk2"
                                            value="{{ json_encode($peminjam->barangs->where('status', 'Dikonfirmasi')->pluck('kode_barang')->toArray()) }}"
                                            readonly>
                                        <div id="scan-native2">

                                        </div>
                                        <div id="sad2" class=" text-danger"></div>
                                        <div class="d-flex justify-content-center">
                                            <div id="hasil_scan2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="cekIn2" data-bs-backdrop="static" data-bs-focus='true'
                        data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h5 class="modal-title">Pengembalian Barang</h5>
                                    <button type="button" class="btn-close" id="tutupCekIn2"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="content">
                                        <input type="hidden" class="form-control" id="jkIn2"
                                            value="{{ json_encode($peminjam->barangs->whereIn('status', ['Dipinjamkan', 'Terlambat'])->pluck('kode_barang')->toArray()) }}"
                                            readonly>
                                        <input type="hidden" class="form-control" id="statusIn2"
                                            value="{{ $peminjam->status }}" readonly>
                                        <input type="hidden" class="form-control" id="peminjamIdIn2"
                                            value="{{ $peminjam->id }}" readonly>
                                        <div id="scan-native">

                                        </div>

                                        <div id="sadIn2" class=" text-danger">

                                        </div>
                                        <div id="content-status2">

                                        </div>
                                        <div class="mt-1 d-flex">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer" id="konfirmasi-div-scan2" style="display:none;">
                                    <button id="konfirmasi-scan2" class="btn btn-success ms-auto"
                                        data-url="{{ url('/peminjam/daftar-client/check-in-konfirmasi') }}">konfirmasi</button>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div id="hidden-area" style="display:none;">
                        <div id="scan-qr" class="row gx-1 justify-content-center">
                            <button class="btn btn-primary mb-3 shadow " id="btn-scan-qr">Scan</button>
                            <div class="col-8">
                                <label for="outputData" class="form-label">Enter Your QRcode : </label>
                                <input type='text' class="form-control mb-3 " id="outputData" autofocus>
                            </div>
                            <canvas hidden="" class="mb-3 border border-dark rounded rounded-4 "
                                id="qr-canvas"></canvas>

                            <div id="gambar-qr" class=" pt-3 pb-3 mx-auto" style="max-width: 200px">
                                <img src=/image/placeholder/qrcode.png class="rounded mx-auto img-fluid" alt="qr code">
                            </div>
                        </div>
                    </div>
                @endif
            @endif



            <div class="modal fade" id="help" aria-hidden="true" data-bs-backdrop="static"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Help</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <button class="btn btn-primary m-1" data-bs-target="#help2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Tatacara peminjaman barang</button>

                            <button class="btn btn-primary m-1" data-bs-target="#help3" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Tatacara pengembalian barang</button>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="help2" aria-hidden="true" data-bs-backdrop="static"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Tatacara Peminjaman barang
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column justify-content-center">

                            <div class="d-flex flex-column mb-3 align-items-center">
                                <div>
                                    <p class="text-center">Pastikan peminjam Membawa KTM yang di daftarkan dan surat permohonan peminjman barang</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>

                                <div>
                                    <p>Pastikan status peminjam sudah "Dikonfirmasi"</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p class="text-center">Klik menu peminjaman barang dan scan kode qr barang yang telah di
                                        pilih oleh aplikasi</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Barang berhasil dipinjamkan</p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="help3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel3" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Tatacara Pengembalian Barang
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column justify-content-center">

                            <div class="d-flex flex-column mb-3 align-items-center">
                                <div>
                                    <p class="text-center">Pastikan Peminjam membawa KTM yang di daftarkan dan surat
                                        permohonan peminjaman barang</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>

                                <div>
                                    <p class="text-center">Cek kodisi barang yang dikembalikan</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p class="text-center">Klik menu pengambalian barang dan scan kode qr barang yang dikembalikan dan ganti satus barang jika ditemukan barang yang rusak atau rusak ringan</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Barang berhasil dikembalikan</p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        </div>
                    </div>
                </div>



            </div>
    </div>


    </main>
    </div>

    <script src="/js/qrCodeScanner.js"></script>
    <script>
        $(document).ready(function() {

            function readQr() {
                var kode = $('#jk2').val();
                var tex = $(this).val();
                if (tex !== "") {
                    $.get("/peminjam/daftar-client/check-out", {
                            kode_barang: kode,
                            check: tex,
                        })
                        .done(function(data) {
                            if (data['success']) {
                                var p = document.createElement("p");
                                var icon = document.createElement("i")
                                p.innerHTML = `${data.kode} `;
                                icon.className = "text-success fa-solid fa-check"
                                p.append(icon);
                                $('#sad2').html('');
                                $('#hasil_scan2').append(p);
                                $('#outputData').val("").focus();
                            } else {
                                // alert(data);
                                $('#sad2').html(
                                    'Kode barang yang di inputkan salah');
                                $('#outputData').val("").focus();
                            }
                        });
                    if (result) $('#outputData2').val("").focus();
                }

            }
            $('#tutupCek2').click(function() {
                var scanArea = $('#cek2').find("#scan-qr");
                $('#hidden-area').append(scanArea);
                $('#cek2').modal('hide');
                location.reload();
            })
            $('#cek2').on('shown.bs.modal', function(event) {
                var scanArea = $('#scan-qr');
                $('#scan-native2').append(scanArea);
                $('#cek2').click(function() {
                    $('#outputData').val("").focus();
                });
                $('#outputData').val("").focus();
                $('#outputData').focusout(readQr);
                $('#outputData').change(readQr);
            });



            function readQrIn() {
                var kode = $('#jkIn2').val();
                var tex = $(this).val();
                if (tex !== "") {
                    $.get("/peminjam/daftar-client/check-in", {
                            kode_barang: kode,
                            check: tex,
                        })
                        .done(function(data) {
                            if (data['success']) {
                                var div1 = document.createElement("div");
                                div1.className =
                                    'qrbarang row gx-1 d-flex justify-content-center';

                                var div2 = document.createElement("div");
                                div2.className =
                                    'd-flex flex-column justify-content-center col-5'

                                var div3 = document.createElement("div");
                                div3.className =
                                    'd-flex pls flex-column justify-content-center col-5'

                                var input = document.createElement("input");
                                input.value = data.kode;
                                input.className = "form-control barang";
                                input.readOnly = true;

                                var kondisi = document.createElement("select");
                                kondisi.className = "form-select kondisi";

                                var option3 = document.createElement("option");
                                option3.value = 'Bagus';
                                option3.innerHTML = 'Bagus';
                                kondisi.appendChild(option3);

                                var option2 = document.createElement("option");
                                option2.value = 'Rusak';
                                option2.innerHTML = 'Rusak';
                                kondisi.appendChild(option2);

                                var option = document.createElement("option");
                                option.value = 'Rusak Ringan';
                                option.innerHTML = 'Rusak Ringan';
                                kondisi.appendChild(option);

                                div2.appendChild(input);
                                div3.appendChild(kondisi);
                                div1.appendChild(div2);
                                div1.appendChild(div3);

                                $('#content-status2').append(div1);
                                if ($('#content-status2').children().length > 0) {
                                    $('#konfirmasi-div-scan2').show();
                                }
                                $('#sadIn2').html('');
                                $('#outputData').val("").focus();
                            } else if (data['success'] == false) {
                                // alert(data);
                                $('#sadIn2').html(
                                    'kode barang yang di inputkan salah');
                                $('#outputData').val("").focus();
                            } else {
                                alert('oops something went wrong')
                            }
                        });
                    // if (result) $('#input_scanIn').val("").focus();
                }

                // e.preventDefault();
            }

            $('#tutupCekIn2').click(function() {
                var scanArea = $('#cekIn2').find("#scan-qr");
                $('#hidden-area').append(scanArea);
                $('#cekIn2').modal('hide');
                location.reload();
            });
            $('#cekIn2').on('shown.bs.modal', function(event) {

                var scanArea = $('#scan-qr');
                $('#scan-native').append(scanArea);
                $('.kondisi').change(function() {
                    $('#outputData').focus();
                })
                $('#outputData').val("").focus();
                $('#outputData').focusout(readQrIn);
                $('#outputData').change(readQrIn);


            });
            $('#konfirmasi-scan2').click(function() {
                var barangs = [];
                $(".qrbarang").each(function() {
                    var barang = [];
                    barang.push($(this).find('.barang').val());
                    barang.push($(this).find('.kondisi').val());
                    barangs.push(barang);
                });
                var stringify = JSON.stringify(barangs)
                var peminjamId = $('#peminjamIdIn2').val();
                var status = $('#statusIn2').val();
                $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        barangs: stringify,
                        id_peminjam: peminjamId,
                        status: status,
                    },
                    success: function(data) {
                        if (data['success']) {
                            window.location = data.url;
                            // alert(data['kode']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert(data);
                        }
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".sub_chk").prop('checked', true);
            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            if ({{ auth()->user()->level == 'Admin' }}) {

                $('.konfirmasi').on('click', function(e) {
                    var allVals = [];
                    $(".sub_chk:checked").each(function() {
                        allVals.push($(this).attr('data-id'));
                    });
                    if (allVals.length <= 0) {
                        alert("Please select row.");
                    } else {
                        var join_selected_values = allVals.join(",");
                        var jumlah = allVals.length;
                        $("#Jkonfirmasi").html(`Konfirmasi ${jumlah} peminjaman barang?`);
                        $('#konfirmasiId').val(join_selected_values);
                        $('#modalyakin').modal('show')
                    }
                });

                $('.tolak').on('click', function(e) {
                    $('#modalTolak').modal('show')
                });
            }


        });
    </script>
@endsection
