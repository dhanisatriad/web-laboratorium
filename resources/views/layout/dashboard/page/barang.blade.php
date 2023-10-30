@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                @if (session()->has('success'))
                    <div class="alert alert-primary border-dark alert-dismissible fade show my-3" role="alert">
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
                <div class="card my-4 shadow">
                    <div class="card-header text-white row fw-bold bg-primary fs-4 m-0">
                        <div class="col-md-12  col-xxl-4">
                            <i class="fas fa-table me-1"></i>
                            Daftar Barang {{ $title }}
                        </div>
                        @if ($modals == 'active')
                            @if ($title == 'Rusak')
                                <div class="col-md-12 col-xl-5 col-xxl-4 d-flex justify-content-center">
                                    <button class="btn btn-primary border border-light dropdown-toggle "
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fa-solid fa-square-caret-down"></i>
                                        Tambah Barang</button>
                                    <ul class="dropdown-menu bg-primary">
                                        <li><a class="dropdown-item text-white text-decoration-none"
                                                href="{{ route('addBarangRusak') }}">Manual</a></li>
                                        <li><button class="dropdown-item text-white" data-bs-toggle="modal"
                                                data-bs-target="#cekIn2">Via Barcode</button>
                                        </li>

                                    </ul>

                                    <button
                                        class="btn btn-primary border border-light dropdown-toggle  {{ $barangs->count() <= 0 ? 'disabled' : '' }}"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="fa-solid fa-square-caret-up"></i>
                                        Keluarkan Barang</button>
                                    <ul class="dropdown-menu bg-primary">
                                        <li><button id="not_rusak_all"
                                                data-url="{{ url('/dashboard/daftar-barang/muti-check-out') }}"
                                                class="dropdown-item text-white">Selected</button></li>

                                        <li><button class="dropdown-item text-white" data-bs-toggle="modal"
                                                data-bs-target="#cek2">Via Barcode</button>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="col-md-12 col-xxl-4 d-flex justify-content-center">
                                    <button class="btn btn-primary border border-light" data-bs-toggle="modal"
                                        data-bs-target="#tambahBarang">
                                        Tambah Barang</button>
                                </div>
                            @endif
                        @endif
                        <div class="col-md-12 col-xxl-4 m-xxl-0 mt-1  ms-lg-auto">
                            <form class="" action="<?php echo URL::current(); ?>">
                                <div class="input-group">
                                    <input type="text" class="form-control border border-light" placeholder="search..."
                                        name="search" value={{ request('search') }}>
                                    <button class="btn btn-primary border-light" type="submit"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        @if ($barangs->count())
                        @endif
                        @if ($add == 'daflab')
                            <div class="col-xl-4 col-md-12 mb-4">
                                <div class="card shadow  py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div>
                                                    <h5 class="text-success text-uppercase mb-1">
                                                        {{ $labels->nama_laboratorium }}</h5>
                                                    <p>Kode Laboratorium : {{ $labels->kode_laboratorium }}
                                                        <br> Jumlah barang : {{ $labels->barangs->count() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-door-open fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($add == 'dafRuang')
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card shadow  py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div>
                                                    <h5 class="text-success text-uppercase mb-1">
                                                        Penyimpanan : {{ $labels->nama_lokasi }}</h5>
                                                    <p>Kode Ruang Penyimpanan : {{ $labels->kode_lokasi }}
                                                        <br>Jumlah barang : {{ $labels->barangs->count() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-location-dot fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($barangs->count())
                            <div class="btn-toolbar justify-content-center" role="toolbar">
                                <div class="btn-group m-1" role="group">

                                    <input type="checkbox" class="btn-check" id="master" autocomplete="off">
                                    <label class="btn btn-primary show-hid border border-light text-nowrap"
                                        for="master"><i class="fa-solid fa-check"></i>
                                        <div class="hid-text"> select
                                            all </div>
                                    </label>



                                    <div class="btn-group" role="group">
                                        <button type="button"
                                            class="btn btn-primary dropdown-toggle border border-light show-hid"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-cart-flatbed"></i>
                                            <div class="hid-text"> Migrate Selected</div>
                                        </button>
                                        <ul class="dropdown-menu buttonMigrate bg-primary">
                                            <li><button class="dropdown-item text-white" data-bs-toggle="modal"
                                                    data-bs-target="#migrateLabor">Migrate Laboratorium</button></li>
                                            <li><button class="dropdown-item text-white" data-bs-toggle="modal"
                                                    data-bs-target="#migrateRuang">Migrate Ruang Penyimpanan</button>
                                            </li>
                                        </ul>
                                    </div>

                                    <button class="btn btn-primary print_all border-light show-hid text-nowrap"><i
                                            class="fa-solid fa-print"></i>
                                        <div class="hid-text"> Print Selected</div>
                                    </button>

                                    <button class="btn btn-primary delete_all border-light show-hid text-nowrap"
                                        data-url="{{ url('/dashboard/daftar-barang/delete-all') }}"><i
                                            class="fa-solid fa-trash"></i>
                                        <div class="hid-text"> Delete Selected</div>
                                    </button>
                                </div>
                                <br>


                            </div>
                        @endif
                        @if ($barangs->count())
                            {{-- </div> --}}
                            <table id="datatablesSimple"
                                class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                <thead class="bg-primary fs-6">
                                    <tr class="text-white text-center">
                                        <th>Select</th>
                                        <th class="thShort" style="min-width: 80px">No. <i
                                                class="short ms-2 fa-solid fa-sort"></i></th>
                                        <th style="min-width: 110px">Nama Barang</th>
                                        <th style="min-width: 95px">Kode Barang</th>
                                        <th class="thShort">Milik Lab <i class="short ms-3 fa-solid fa-sort"
                                                style="cursor: pointer"></i></th>
                                        <th class="thShort" style="min-width: 170px">Lokasi Penyimpanan <i
                                                class="short ms-3 fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th class="thShort" style="min-width: 110px">Kondisi <i
                                                class="short ms-3 fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th class="thShort" style="min-width: 100px">Status <i
                                                class="short ms-3 fa-solid fa-sort" style="cursor: pointer "></i></th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($barangs as $barang)
                                        @php
                                            // dd($barang);
                                        @endphp
                                        <tr>
                                            <td class="text-center"><input type="checkbox" class="sub_chk"
                                                    data-id="{{ $barang->id }}"
                                                    @if ($barang->status == 'Dipinjamkan' || $barang->status == 'Dikonfirmasi') {{ 'disabled' }} @endif></td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('daftar-barang.show', $barang->kode_barang) }}">
                                                {{ $loop->iteration }}</td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('daftar-barang.show', $barang->kode_barang) }}"><a
                                                    class="text-decoration-none text-black text-break text-center"
                                                    href="{{ route('daftar-barang.show', $barang->kode_barang) }}">{{ $barang->nama_barang }}</a>
                                            </td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('daftar-barang.show', $barang->kode_barang) }}">
                                                {{ $barang->kode_barang }}</td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('daftar-laboratorium.show', $barang->laboratorium->kode_laboratorium) }}">
                                                <a class="text-decoration-none text-black "
                                                    href="{{ route('daftar-laboratorium.show', $barang->laboratorium->kode_laboratorium) }}">{{ $barang->laboratorium->nama_laboratorium }}</a>
                                            </td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('lokasi-penyimpanan.show', $barang->lokasi_penyimpanan->kode_lokasi) }}">
                                                <a class="text-decoration-none text-black"
                                                    href="{{ route('lokasi-penyimpanan.show', $barang->lokasi_penyimpanan->kode_lokasi) }}">{{ $barang->lokasi_penyimpanan->nama_lokasi }}</a>
                                            </td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('daftar-barang.show', $barang->kode_barang) }}">
                                                {{ $barang->kondisi }}</td>

                                            <td class="text-center clickable-cell"
                                                data-href="{{ route('daftar-barang.show', $barang->kode_barang) }}">
                                                {{ $barang->status }}</td>

                                            <td class="text-center">
                                                {{-- <button
                                                    class="btn btn-sm btn-warning text-light m-1 @if ($barang->status == 'Dipinjamkan' || $barang->status == 'Dikonfirmasi') {{ 'disabled' }} @endif "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editBarang{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></button> --}}

                                                <button
                                                    class="mny btn btn-sm btn-warning text-light m-1 @if ($barang->status == 'Dipinjamkan' || $barang->status == 'Dikonfirmasi') {{ 'disabled' }} @endif "
                                                    data-barang="{{ json_encode($barang) }}"><i
                                                        class="fa-solid fa-pen-to-square "></i></button>

                                                <button
                                                    class="btn btn-sm btn-danger m-1 @if ($barang->status == 'Dipinjamkan' || $barang->status == 'Dikonfirmasi') {{ 'disabled' }} @endif "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusBarang{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-trash"></i></button>


                                            </td>

                                        </tr>
                                        @if ($modals == 'active')
                                            {{-- ----------modal hapus barang----------- --}}
                                            <div class="modal fade" id="hapusBarang{{ $loop->iteration }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-light">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Barang
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Hapus data barang {{ $barang->nama_barang }}?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>

                                                            <form
                                                                action="{{ route('daftar-barang.destroy', $barang->kode_barang) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn bg-danger"
                                                                    id="hapus">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                        @endif
                                        {{-- ----------modal hapus barang----------- --}}
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $barangs->links() }}
                            </div>
                            {{-- -------------------------------------------------------------modal migrate labor-------------------------------------------------------- --}}
                            <div class="modal fade" id="migrateLabor" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                Migrate Laboratorium
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label" for="labTujuan">Nama
                                                    laboratorium Tujuan</label>
                                                <select class="form-select" id="labTujuan" name="labTujuan">
                                                    @foreach ($labs as $labo)
                                                        <option value={{ $labo->id }}>
                                                            {{ $labo->nama_laboratorium }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary migrate_all"
                                                data-url="{{ url('/dashboard/daftar-barang/migrate-all') }}">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- -------------------------------------------------------------modal migrate labor-------------------------------------------------------- --}}

                            {{-- -------------------------------------------------------------modal migrate ruang-------------------------------------------------------- --}}
                            <div class="modal fade" id="migrateRuang" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title text-white" id="staticBackdropLabel">
                                                Migrate Ruang Penyimpanan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label" for="lokasiTujuan">Nama
                                                    Ruang Penyimpanan Tujuan</label>
                                                <select class="form-select" id="lokasiTujuan" name="lokasiTujuan">
                                                    @foreach ($lokasis as $lokas)
                                                        <option value={{ $lokas->id }}>
                                                            {{ $lokas->nama_lokasi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary migrateRuang_all"
                                                data-url="{{ url('/dashboard/daftar-barang/migrateRuang-all') }}">Simpan</button>

                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- -------------------------------------------------------------modal migrate barang-------------------------------------------------------- --}}
                            <div class="modal fade" id="modalyakin" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="exampleModalLabel">Print Kode Barang</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="jumlahPrint">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form method="POST" action="{{ route('printMulti') }}">
                                                @csrf
                                                <input type="hidden" name="ids" id="printId">
                                                <button class="btn btn-primary"><i
                                                        class="fa-solid fa-print me-2"></i>Print
                                                    Selected</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center fs-4">Barang kosong</p>
                        @endif
                    </div>
                </div>
                @if ($modals == 'active' && $title != 'Rusak')
                    {{-- ----------modal tambah barang----------- --}}
                    <div class="modal fade in" id="tambahBarang" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('daftar-barang.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 fw-bold col-3">
                                            <label for="jumlahb" class="form-label">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlahb" name="jumlahb"
                                                min="1" value="1">
                                        </div>
                                        <div class="mb-3  fw-bold">
                                            <label for="nama_barang" class="form-label">Nama Barang</label>
                                            <input type="text"
                                                class="form-control @error('nama_barang') is-invalid @enderror"
                                                id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                                                maxlength="255" required>
                                            @error('nama_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="mb-3  fw-bold">
                                            <label class="form-label" for="laboratorium_id">Laboratorium</label>
                                            <select class="form-select" id="laboratorium_id" name="laboratorium_id"
                                                required>
                                                <option selected hidden disabled></option>
                                                @foreach ($labs as $lab)
                                                    @if (old('laboratorium_id') == $lab->id)
                                                        <option value="{{ $lab->id }}" selected>
                                                            {{ $lab->nama_laboratorium }}
                                                        </option>
                                                    @else
                                                        <option value={{ $lab->id }}>{{ $lab->nama_laboratorium }}
                                                    @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 fw-bold">
                                            <label class="form-label" for="lokasi_penyimpanan_id">Ruang
                                                Penyimpanan</label>
                                            <select class="form-select" id="lokasi_penyimpanan_id"
                                                name="lokasi_penyimpanan_id" required>
                                                <option selected disabled hidden></option>
                                                @foreach ($lokasis as $lokasi)
                                                    @if (old('lokasi_penyimpanan_id') == $lokasi->id)
                                                        <option value="{{ $lokasi->id }}" selected>
                                                            {{ $lokasi->nama_lokasi }}
                                                        </option>
                                                    @else
                                                        <option value={{ $lokasi->id }}>{{ $lokasi->nama_lokasi }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3  fw-bold">
                                            <label for="kode_barang" class="form-label"> kode Barang </label>
                                            <input type="text"
                                                class="form-control @error('kode_barang') is-invalid @enderror"
                                                id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}"
                                                maxlength="25" required>
                                            @error('kode_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gambar_barang" class="form-label fw-bold">Gambar Barang</label>
                                            <img class="img_prev img-fluid mb-3 col-sm-5">
                                            <input
                                                class="form-control border-dark @error('gambar_barang') is-invalid @enderror"
                                                type="file" id="gambar_barang" accept="image/png, image/jpeg"
                                                onchange="prevImg()" name="gambar_barang">
                                            @error('gambar_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="part" class="form-label fw-bold">Part</label>
                                            <input id="part" type="hidden" value="{{ old('part') }}"
                                                name="part">
                                            <trix-editor input="part"></trix-editor>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                            <input id="deskripsi" type="hidden" name="deskripsi">
                                            <trix-editor input="deskripsi"></trix-editor>
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="modal fade in" id="bruh" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="form" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama_barang" class="form-label fw-bold">Nama
                                                Barang</label>
                                            <input type="text" class="form-control" id="nama_barangE"
                                                name="nama_barang" maxlength="255">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold" for="laboratorium_idE">Nama
                                                laboratorium</label>
                                            <select class="form-select" id="laboratorium_idE" name="laboratorium_id">
                                                @foreach ($labs as $lab)
                                                    <option value={{ $lab->id }}>
                                                        {{ $lab->nama_laboratorium }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold" for="inputGroupSelect02">Nama
                                                Ruang
                                                penyimpanan</label>
                                            <select class="form-select" id="inputGroupSelect02"
                                                name="lokasi_penyimpanan_id">
                                                @foreach ($lokasis as $ruang)
                                                    <option value={{ $ruang->id }}>
                                                        {{ $ruang->nama_lokasi }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_barang" class="form-label fw-bold">Kode
                                                Barang</label>
                                            <input type="text" class="form-control" id="kode_barangE"
                                                name="kode_barang" maxlength="25">
                                            <p class="fw-lighter">*Double Click untuk membuat kode barang otomatis</p>
                                            <p id="sadInE"></p>
                                        </div>
                                        <label class="form-label fw-bold">Kondisi</label>
                                        <div class="input-group mb-3">
                                            {{-- <label for="kondisi" class="form-label">Kondisi</label> --}}
                                            <div class="form-check form-check-inline ms-2">
                                                <input class="form-check-input" type="radio" name="kondisi"
                                                    id="exampleRadios1" value="Bagus">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Bagus
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi"
                                                    id="exampleRadios3" value="Rusak Ringan">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Rusak Ringan
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi"
                                                    id="exampleRadios2" value="Rusak">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Rusak
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gambar_barang" class="form-label fw-bold">Gambar Barang</label>
                                            <input type="hidden" id="old_image" name="old_image">
                                            <img class="img_prevE img-fluid mb-3 col-sm-5 d-block">
                                            <input
                                                class="form-control border-dark @error('gambar_barang') is-invalid @enderror"
                                                type="file" id="gambar_barangE" accept="image/png, image/jpeg"
                                                onchange="prevImgE()" name="gambar_barang">
                                            @error('gambar_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                            <input id="deskripsi" type="hidden" name="deskripsi">
                                            <trix-editor id="dekripsi" input="deskripsi">
                                            </trix-editor>
                                        </div> --}}
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- ----------modal tambah barang----------- --}}
                @endif

                @if ($title == 'Rusak')
                    <div class="modal fade in" id="bruh" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="form" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama_barang" class="form-label fw-bold">Nama
                                                Barang</label>
                                            <input type="text" class="form-control" id="nama_barangE"
                                                name="nama_barang" maxlength="255">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold" for="laboratorium_idE">Nama
                                                laboratorium</label>
                                            <select class="form-select" id="laboratorium_idE" name="laboratorium_id">
                                                @foreach ($labs as $lab)
                                                    <option value={{ $lab->id }}>
                                                        {{ $lab->nama_laboratorium }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold" for="inputGroupSelect02">Nama
                                                Ruang
                                                penyimpanan</label>
                                            <select class="form-select" id="inputGroupSelect02"
                                                name="lokasi_penyimpanan_id">
                                                @foreach ($lokasis as $ruang)
                                                    <option value={{ $ruang->id }}>
                                                        {{ $ruang->nama_lokasi }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_barang" class="form-label fw-bold">Kode
                                                Barang</label>
                                            <input type="text" class="form-control" id="kode_barangE"
                                                name="kode_barang" maxlength="25">
                                            <p class="fw-lighter">*Double Click untuk membuat kode barang otomatis</p>
                                            <p id="sadInE"></p>
                                        </div>
                                        <label class="form-label fw-bold">Kondisi</label>
                                        <div class="input-group mb-3">
                                            {{-- <label for="kondisi" class="form-label">Kondisi</label> --}}
                                            <div class="form-check form-check-inline ms-2">
                                                <input class="form-check-input" type="radio" name="kondisi"
                                                    id="exampleRadios1" value="Bagus">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Bagus
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi"
                                                    id="exampleRadios3" value="Rusak Ringan">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Rusak Ringan
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kondisi"
                                                    id="exampleRadios2" value="Rusak">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Rusak
                                                </label>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-3">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                    <input id="deskripsi" type="hidden" name="deskripsi">
                                    <trix-editor id="dekripsi" input="deskripsi">
                                    </trix-editor>
                                </div> --}}


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal fade" id="cek2" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h5 class="modal-title">Keluarkan Barang Rusak via QRcode</h5>
                                    <button type="button" class="btn-close" id="tutupCek2"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="content">
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

                    <div class="modal fade" id="cekIn" data-bs-backdrop="static" data-bs-focus='true'
                        data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h5 class="modal-title">Tambahkan Barang Rusak via QRcode</h5>
                                    <button type="button" class="btn-close" id="tutupCekIn"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="content">
                                        <div class="row gx-1 d-flex justify-content-center">
                                            <div class="col-8">
                                                <label for="input_scanIn" class="form-label">Enter Your QRcode : </label>
                                                <input type='text' class="form-control" id="input_scanIn">
                                            </div>
                                        </div>

                                        <div class="pt-3 pb-3 mx-auto d-block" style="max-width: 200px">
                                            <img src=/image/placeholder/qrcode.png
                                                class="rounded mx-auto d-block img-fluid" alt="qr code">
                                        </div>
                                        <div id="sadIn" class=" text-danger">

                                        </div>
                                        <div id="content">

                                        </div>
                                        <div class="mt-1 d-flex">
                                            <button id="konfirmasi" class="btn btn-success ms-auto"
                                                data-url="{{ url('/dashboard/daftar-barang/konfirmasi-rusak') }}">konfirmasi</button>
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
                                    <h5 class="modal-title">Tambahkan Barang Rusak via QRcode</h5>
                                    <button type="button" class="btn-close" id="tutupCekIn2"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="content">
                                        <div id="scan-native">

                                        </div>

                                        <div id="sadIn2" class=" text-danger">

                                        </div>
                                        <div id="content2">

                                        </div>
                                        <div class="mt-1 d-flex">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="konfirmasi2" class="btn btn-success ms-auto"
                                        data-url="{{ url('/dashboard/daftar-barang/konfirmasi-rusak') }}">konfirmasi</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hidden-area" style="display:none;">
                        <div id="scan-qr" class="row gx-1 justify-content-center">
                            <button class="btn btn-primary mb-3 shadow " id="btn-scan-qr">Scan Dengan Native
                                Camera</button>
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

            </div>
        </main>
    </div>

    {{-- <script type="text/javascript">
        var route = "{{ url('autocomplete') }}";
        $('#nama_barang').typeahead({
            source: function (str, process) {
                return $.get(route, {
                    str: str
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script> --}}
    <script>
        document.addEventListener('animationstart', function(e) {
            if (e.animationName === 'fade-in') {
                e.target.classList.add('did-fade-in');
            }
        });


        document.addEventListener('animationend', function(e) {
            if (e.animationName === 'fade-out') {
                e.target.classList.remove('did-fade-in');
            }
        });

        function prevImg() {
            const input = document.querySelector('#gambar_barang');
            const prev = document.querySelector('.img_prev');
            prev.style.display = 'block';
            prev.style.border = 'thin solid #000000';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);
            oFReader.onload = function(ofREvent) {
                prev.src = ofREvent.target.result;
            }
        }

        function prevImgE() {
            const input = document.querySelector('#gambar_barangE');
            const prev = document.querySelector('.img_prevE');
            prev.style.display = 'block';
            prev.style.border = 'thin solid #000000';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[0]);
            oFReader.onload = function(ofREvent) {
                prev.src = ofREvent.target.result;
            }
        }
    </script>
    <script src="/js/qrCodeScanner.js"></script>
    <script>
        $(document).ready(function() {

            function readQR() {
                var tex = $(this).val();
                if (tex !== "") {
                    $.get("/dashboard/daftar-barang/check-out", {
                            // kode_barang: kode,
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
                    if (result) $('#outputData').val("").focus();
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
                $('#outputData').focusout(readQR);
                $('#outputData').change(readQR);
            });



            function readQrIn() {
                var tex = $(this).val();
                if (tex !== "") {
                    $.get("/dashboard/daftar-barang/check-in", {
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

                                $('#content2').append(div1);

                                $('#sadIn2').html('');
                                $('#outputData').val("").focus();
                            } else {
                                // alert(data);
                                $('#sadIn2').html(
                                    'kode barang yang di inputkan salah');
                                $('#outputData').val("").focus();
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
            $('#konfirmasi2').click(function() {
                var barangs = [];
                $(".qrbarang").each(function() {
                    var barang = [];
                    barang.push($(this).find('.barang').val());
                    barang.push($(this).find('.kondisi').val());
                    barangs.push(barang);
                });
                var stringify = JSON.stringify(barangs)
                $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        barangs: stringify,
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



            $('#not_rusak_all').on('click', function(e) {
                var allVals = [];
                // var labTujuan = $('#labTujuan').val();
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ids: join_selected_values,
                                // laboratorium_id: labTujuan
                            },
                            success: function(data) {
                                if (data['success']) {
                                    window.location = data.url;
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
                    }
                }
            });




            $(".clickable-cell").click(function() {
                console.log('nasi');
                window.location = $(this).data("href")
            });

            $('.thShort').click(function() {
                var table = $(this).parents('table').eq(0)
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
                this.asc = !this.asc
                if (!this.asc) {
                    rows = rows.reverse()
                }
                for (var i = 0; i < rows.length; i++) {
                    table.append(rows[i])
                }
            })

            function comparer(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index),
                        valB = getCellValue(b, index)
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(
                        valB)
                }
            }

            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text()
            }

            // $('#datatablesSimple').bootstrapTable({
            //     shorting: true
            // })


            createKodeE = function() {
                var nama_barang = $('#nama_barangE').val();
                var laboratorium = $('#laboratorium_idE').val();


                $.get("/dashboard/daftar-barang/CreatekodeBarang", {
                        nama_barang: nama_barang,
                        laboratorium: laboratorium,
                        // status: status
                    })
                    .done(function(data) {
                        console.log(data.kode);
                        if (data['success']) {
                            $('#kode_barangE').val(data.kode);
                        } else {
                            $('#sadInE').html(
                                'kode barang yang di inputkan salah');
                        }
                    });
            };
            $('#kode_barangE').dblclick(createKodeE);


            $('.mny').click(function() {
                var nasi = $(this).attr('data-barang');
                var ayam = jQuery.parseJSON(nasi);
                $('#bruh').modal('show');
                $('#bruh').on('shown.bs.modal', function(event) {
                    $('#form').attr('action', "/dashboard/daftar-barang/" + ayam.kode_barang);
                    $('#nama_barangE').val(ayam.nama_barang);
                    $('#laboratorium_idE').val(ayam.laboratorium_id);
                    $('#inputGroupSelect02').val(ayam.lokasi_penyimpanan_id);
                    $('#kode_barangE').val(ayam.kode_barang);
                    $('#kode_barangE').val(ayam.kode_barang);
                    if (ayam.gambar_barang !== null) {
                        $('.img_prevE').attr("src",
                            `{{ asset('storage/${ayam.gambar_barang}') }}`);
                        $('.img_prevE').css('border', 'thin solid black');
                        $('#gambar_barangE').val('');
                        $('#old_image').val(ayam.gambar_barang);
                    } else {
                        $('.img_prevE').attr("src", "");
                        $('.img_prevE').css('border', '');
                        $('#gambar_barangE').val('');
                        $('#old_image').val('');
                    }
                    if (ayam.kondisi == 'Bagus') {
                        $("input[name=kondisi][value='Bagus']").prop("checked", true);
                    } else if (ayam.kondisi == 'Rusak') {
                        $("input[name=kondisi][value='Rusak']").prop("checked", true);
                    } else if (ayam.kondisi == 'Rusak Ringan') {
                        $("input[name=kondisi][value='Rusak Ringan']").prop("checked", true);
                    };
                });
            });

            $('#nama_barang').alphanum({
                allow: '().-_/',
            });
            $('#nama_barangE').alphanum({
                allow: '().-_/',
            });
            $('#kode_barang').alphanum({
                allow: '().-_/',
            });
            $('#kode_barangE').alphanum({
                allow: '().-_/',
            });
            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                    $(".sub_chk[disabled]").prop('checked', false);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            $('.delete_all').on('click', function(e) {
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    window.location = data.url;
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                        $.each(allVals, function(index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });

            $('.migrate_all').on('click', function(e) {
                var allVals = [];
                var labTujuan = $('#labTujuan').val();
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to migrate this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ids: join_selected_values,
                                laboratorium_id: labTujuan
                            },
                            success: function(data) {
                                if (data['success']) {
                                    window.location = data.url;
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
                    }
                }
            });

            $('.migrateRuang_all').on('click', function(e) {
                var allVals = [];

                var lokasiTujuan = $('#lokasiTujuan').val();
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));

                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to migrate this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ids: join_selected_values,
                                stats: join_selected_stats,
                                lokasi_penyimpanan_id: lokasiTujuan
                            },
                            success: function(data) {
                                if (data['success']) {
                                    window.location = data.url;
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
                    }
                }
            });

            $('.print_all').on('click', function(e) {
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var join_selected_values = allVals.join(",");
                    var jumlah = allVals.length;
                    // console.log(jumlah);
                    $("#jumlahPrint").html(`Apakah anda yakin untuk print ${jumlah} kode barang?`);
                    $('#printId').val(join_selected_values);
                    $('#modalyakin').modal('show')
                }
            });



        });
    </script>


    <script>
        var createKode = function() {
            var nama_barang = $('#nama_barang').val();
            var laboratorium = $('#laboratorium_id').val();

            // console.log(nama_barang);
            $.get("/dashboard/daftar-barang/CreatekodeBarang", {
                    nama_barang: nama_barang,
                    laboratorium: laboratorium,
                    // status: status
                })
                .done(function(data) {
                    console.log(data.kode);
                    if (data['success']) {
                        $('#kode_barang').val(data.kode);
                    } else {
                        $('#sadIn').html(
                            'kode barang yang di inputkan salah');
                        $('#input_scanIn').val("").focus();
                    }
                });
        };
        $('#kode_barang').dblclick(createKode);
        $('#nama_barang').change(createKode);
        $('#laboratorium_id').change(createKode);
    </script>
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>
@endsection
