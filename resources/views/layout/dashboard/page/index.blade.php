@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex justify-content-center my-4">
                <h3 class="text-uppercase fw-bold">Dashboard Laboratorium Teknik Elektro</h3>
            </div>
            <div class=" mb-3">
                <a  href="" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#help"><i
                        class="fa-solid fa-circle-question"></i> Help</a>
            </div>

            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card  shadow py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" text-primary text-uppercase mb-1">
                                        Jumlah Barang</div>
                                    <div class="h5 mb-0 fw-bold"><a href="{{ route('daftar-barang.index') }}"
                                            class="text-dark text-decoration-none stretched-link">{{ $jumBarang }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-box fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card  shadow py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" text-primary text-uppercase mb-1">
                                        Client</div>
                                    <div class="h5 mb-0 fw-bold"><a href="{{ route('daftar-client.index') }}"
                                            class="text-dark text-decoration-none stretched-link">{{ $jumClient }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-address-book fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-primary text-uppercase mb-1">
                                        Barang diPinjamkan</div>
                                    <div class="h5 mb-0 fw-bold"><a href="/dashboard/daftar-dipinjam"
                                            class="text-dark text-decoration-none stretched-link">{{ $jumBarangDipinjam }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-cart-shopping fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-primary text-uppercase mb-1">
                                        Barang Rusak</div>
                                    <div class="h5 mb-0 fw-bold"><a href="/dashboard/barang-rusak"
                                            class="text-dark text-decoration-none stretched-link">{{ $jumBarangRusak }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-rectangle-xmark fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-primary text-uppercase mb-1">
                                        Laboratorium</div>
                                    <div class="h5 mb-0 fw-bold"><a href="/dashboard/daftar-laboratorium"
                                            class="text-dark text-decoration-none stretched-link">{{ $jumLabor }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-door-open fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-primary text-uppercase mb-1">
                                        Ruang Penyimpanan</div>
                                    <div class="h5 mb-0 fw-bold"><a href="/dashboard/lokasi-penyimpanan"
                                            class="text-dark text-decoration-none stretched-link">{{ $jumRuang }}</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-location-dot fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card border-left-warning shadow py-2">
                        <div class="card-body row">
                            <div class="row no-gutters align-items-center">
                                <div class="col ">
                                    <div class="text-primary text-uppercase mb-1">
                                        <a href="{{ route('checkView') }}"
                                            class=" text-decoration-none stretched-link">Peminjaman & Pengembalian
                                            Barang</a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="rotate fa-solid fa-right-left fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div>
                    <div class="card mb-4  shadow">
                        <div class="card-header text-white fw-bold bg-primary fs-5 text-uppercase">
                            <i class="fa-solid fa-inbox"></i>
                            Daftar Permohonan Terbaru
                        </div>
                        <div class="card-body table-responsive">
                            @if ($permohonans->count())
                                <table id="datatablesSimple"
                                    class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                    <thead class="bg-primary fs-6">
                                        <tr class="text-white text-center">
                                            <th>No. </th>
                                            <th>Nama </th>
                                            <th>NIM/NIK</th>
                                            <th>Kontak</th>
                                            <th>Kode Peminjaman</th>
                                            <th>Tanggal Mulai Peminjaman</th>
                                            <th>Tanggal Selesai Peminjaman</th>
                                            <th>Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permohonans as $permohonan)
                                            <tr class="clickable-row text-center"
                                                data-href="{{ route('daftar-client.show', $permohonan->kode_peminjaman) }}"
                                                style="cursor: pointer">
                                                <td>
                                                    {{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $permohonan->nama_peminjam }}
                                                </td>
                                                <td>
                                                    {{ $permohonan->nim }}</td>

                                                <td>
                                                    {{ $permohonan->kontak }}</td>
                                                <td>
                                                    {{ $permohonan->kode_peminjaman }}
                                                </td>

                                                <td>{{ date('d-m-Y', strtotime($permohonan->tanggal_pinjam)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($permohonan->tanggal_kembali)) }}</td>
                                                <td
                                                    class="@if ($permohonan->status == 'Selesai*' || $permohonan->status == 'Ditolak') {{ 'bg-danger text-white' }} @endif">
                                                    {{ $permohonan->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center fs-4">Permohonan kosong</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


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
                                    <p class="text-center">Pastikan peminjam Membawa KTM yang di daftarkan dan surat permohonan peminjaman barang</p>

                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Pilih menu <a class="text-decoration-none fw-bold"
                                        href="/dashboard/check-konfirmasi">Check in & check out</a></p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Scan KTM atau ketikan nim pada kolom yang tersedia</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Pilih nama peminjam</p>
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
                                    <p>Pilih menu <a class="text-decoration-none fw-bold"
                                            href="/dashboard/check-konfirmasi">Check in & check out</a></p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Scan KTM atau ketikan nim pada kolom yang tersedia</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Pilih nama peminjam</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p class="text-center">Cek kodisi barang yang dikambalikan</p>
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
    </div>

    <script>
        $(document).ready(function() {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
