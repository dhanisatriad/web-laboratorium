@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                @if (session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    {!! implode(
                        '',
                        $errors->all(' <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>'),
                    ) !!}
                @endif
                <div class="card my-4  shadow">
                    <div class="card-header text-white bg-primary fs-4">
                        <i class="fas fa-table me-1"></i>
                        Daftar Ruang Penyimpanan
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahLokasi">
                            Tambah Ruang penyimpanan</a>
                        @if ($lokasis->count())
                            <table id="datatablesSimple"
                                class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                <thead class="bg-primary fs-6">
                                    <tr class="text-white text-center">
                                        <th>Nama Ruang Penyimpanan</th>
                                        <th>Kode Ruang</th>
                                        <th>Total Jumlah Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lokasis as $lokasi)
                                        <tr class="text-center">
                                            <td><a class="text-decoration-none text-black"
                                                    href="{{ route('lokasi-penyimpanan.show', $lokasi->kode_lokasi) }}">{{ $lokasi->nama_lokasi }}</a>
                                            </td>
                                            <td>{{ $lokasi->kode_lokasi }}</td>
                                            <td>{{ $lokasi->barangs->count() }}</td>
                                            <td>
                                                <button class=" btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#migrateLokasi{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-right-from-bracket"></i></button>
                                                <button class="btn btn-sm btn-warning text-light" data-bs-toggle="modal"
                                                    data-bs-target="#editLokasi{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                                <button class=" btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#hapusLokasi{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        {{-- -------------------------------------------------------------modal migrate ruang-------------------------------------------------------- --}}
                                        <div class="modal fade" id="migrateLokasi{{ $loop->iteration }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="staticBackdropLabel">Migrate
                                                            Ruang Penyimpanan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('daftar-laboratorium.migrateLokasi') }}">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label" for="lokasiAsal">Nama
                                                                    Ruang Penyimpanan Asal</label>
                                                                <select class="form-select" id="lokasiAsal"
                                                                    name="lokasiAsal" required>
                                                                    @foreach ($lokasis as $lokas)
                                                                        <option value={{ $lokas->id }}
                                                                            {{ $lokasi->id === $lokas->id ? 'selected' : '' }}>
                                                                            {{ $lokas->nama_lokasi }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="lokasi_penyimpanan_id">Nama
                                                                    Ruang Penyimpanan Tujuan</label>
                                                                <select class="form-select" id="lokasi_penyimpanan_id"
                                                                    name="lokasi_penyimpanan_id" required>
                                                                    <option selected hidden disabled></option>
                                                                    @foreach ($lokasis as $lokas)
                                                                        <option value={{ $lokas->id }}>
                                                                            {{ $lokas->nama_lokasi }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>

                                                    </div>
                                                    <div class="modal-footer">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- -------------------------------------------------------------modal migrate barang-------------------------------------------------------- --}}



                                        {{-- -------------------------------------------------------------modal edit barang-------------------------------------------------------- --}}
                                        <div class="modal fade" id="editLokasi{{ $loop->iteration }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Ruang
                                                            Penyimpanan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('lokasi-penyimpanan.update', $lokasi->kode_lokasi) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nama_lokasi" class="form-label">Nama
                                                                    Ruang Penyimpana</label>
                                                                <input type="text" class="form-control" id="nama_lokasi"
                                                                    name="nama_lokasi" value="{{ $lokasi->nama_lokasi }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="kode_lokasi" class="form-label">Kode
                                                                    Ruang Penyimpanan</label>
                                                                <input type="text" class="form-control"
                                                                    id="kode_lokasi" name="kode_lokasi"
                                                                    value="{{ $lokasi->kode_lokasi }}">
                                                            </div>

                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>

                                                    </div>
                                                    <div class="modal-footer">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- -------------------------------------------------------------modal edit barang-------------------------------------------------------- --}}


                                        {{-- ----------modal hapus barang----------- --}}
                                        <div class="modal fade" id="hapusLokasi{{ $loop->iteration }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                @if ($lokasi->barangs->count() > 0)
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-light">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus
                                                                Ruang Penyimpanan
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Ruang {{ $lokasi->nama_lokasi }} Tidak kosong
                                                                harap lakukan migrasi terlebih dahulu</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#migrateLokasi{{ $loop->iteration }}">Migrate
                                                                Ruang Penyimpanan</button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-light">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus
                                                                Ruang Penyimpanan
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Hapus data Ruang Penyimpanan {{ $lokasi->nama_lokasi }}?
                                                            </h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <form
                                                                action="{{ route('lokasi-penyimpanan.destroy', $lokasi->kode_lokasi) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn bg-danger"
                                                                    id="hapus">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- ----------modal hapus barang----------- --}}
                                    @endforeach
                                </tbody>
                            </table>

                    </div>
                @else
                    <p class="text-center fs-4">Ruang Penyimpanan kosong</p>
                    @endif
                </div>

                {{-- modal tambah ruang --}}
                <div class="modal fade in" id="tambahLokasi" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Ruang Penyimpanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('lokasi-penyimpanan.store') }}">
                                    @csrf
                                    <div class="mb-3  fw-bold">
                                        <label for="nama_lokasi" class="form-label">Nama Ruang Penyimpanan</label>
                                        <input type="text"
                                            class="form-control @error('nama_lokasi') is-invalid @enderror"
                                            id="nama_lokasi" name="nama_lokasi" value="{{ old('nama_lokasi') }}"
                                            required>
                                        @error('nama_lokasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3  fw-bold">
                                        <label for="kode_lokasi" class="form-label">Kode Ruang Pentyipanan</label>
                                        <input type="text"
                                            class="form-control @error('kode_lokasi') is-invalid @enderror"
                                            id="kode_lokasi" name="kode_lokasi" value="{{ old('kode_lokasi') }}"
                                            required>
                                        @error('kode_lokasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>

                {{-- modal tambah ruang --}}

            </div>
        </main>
    </div>
@endsection
