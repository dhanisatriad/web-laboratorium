@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid  d-flex justify-content-center px-4 mb-5">
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
                <div class="card my-4 col-6  shadow">
                    <div class="card-header text-white fw-bold bg-primary fs-4">
                        <i class="rotate fa-solid fa-right-left me-1"></i>
                        Check In & Check Out Barang

                    </div>
                    <div class="card-body">
                        <div class=" mb-3"><p class="text-decoration-none text-dark" data-bs-toggle="modal"
                                data-bs-target="#help"><i class="fa-solid fa-circle-question"></i> Help</p></div>
                        <form id="form" method="post" action="{{ route('checkNim') }}">
                            @csrf
                            @method('POST')
                            <label for="input_scan" class="form-label">Masukan NIK atau Scan Barcode pada KTM</label>
                            <input type='text' class="form-control border-dark" id="input_scan" name="nim"
                                {{-- class="visually-hidden" --}}>
                            <div class="pt-3 pb-3 mx-auto d-block" style="max-width: 300px">
                                <img src=/image/placeholder/qrcode.png class="rounded mx-auto d-block img-fluid"
                                    alt="qr code">
                            </div>
                            {{-- <button id="input" type="submit" class="btn btn-primary" hidden>Simpan</button> --}}
                    </div>
                    </form>
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
        </main>
    </div>



    <script>
        $(document).ready(function() {
            $(document).click(function() {
                $('#input_scan').focus();
            });
            $('#input_scan').val("").focus();
            $('#input_scan').keyup(function(e) {
                // var kode = $('#jk').val();
                var tex = $(this).val();
                if (tex !== "" && e.keyCode === 13) {
                    // $("#input").trigger("click")
                }
            });
        });
    </script>
@endsection
