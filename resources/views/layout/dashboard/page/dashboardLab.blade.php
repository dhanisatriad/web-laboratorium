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
                @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show my-3" role="alert">
                        {{ session('warning') }}
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
                <div class="card my-4 shadow">
                    <div class="card-header text-white bg-primary fs-4">
                        <i class="fas fa-table me-1"></i>
                        Daftar laboratorium
                    </div>
                    <div class="card-body table-responsive">
                        <a class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahLabor">
                            Tambah Laboratorium</a>
                        @if ($labs->count())
                            <table id="datatablesSimple" class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                <thead class="bg-primary fs-6">
                                    <tr class="text-white text-center">
                                        <th>Nama Laboratorium</th>
                                        <th>Kode Laboratoriums</th>
                                        <th>Total Jumlah Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labs as $lab)
                                        <tr class="text-center">
                                            <td><a class="text-decoration-none text-black"
                                                    href="{{ route('daftar-laboratorium.show', $lab->kode_laboratorium) }}">{{ $lab->nama_laboratorium }}</a>
                                            </td>
                                            <td>{{ $lab->kode_laboratorium }}</td>
                                            <td>{{ $lab->barangs->count() }}</td>
                                            <td>
                                                <button class=" btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#migrateLabor{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-right-from-bracket"></i></button>
                                                <button class="btn btn-sm btn-warning text-light" data-bs-toggle="modal"
                                                    data-bs-target="#editLabor{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                                <button class=" btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#hapusLabor{{ $loop->iteration }}"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        {{-- -------------------------------------------------------------modal migrate labor-------------------------------------------------------- --}}
                                        <div class="modal fade" id="migrateLabor{{ $loop->iteration }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title text-white" id="staticBackdropLabel">Migrate
                                                            Laboratorium
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('daftar-laboratorium.migrateLabor') }}">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="form-label" for="labAsal">Nama
                                                                    laboratorium Asal:</label>
                                                                <h5 class="fw-bold text-success">{{ $lab->nama_laboratorium }}</h5>
                                                                <input type="hidden" class="form-control" id="labAsal"
                                                                    name="labAsal" value="{{ $lab->id }}" required readonly>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label" for="laboratorium_id">Nama
                                                                    laboratorium Tujuan</label>
                                                                <select class="form-select" id="laboratorium_id"
                                                                    name="laboratorium_id" required>
                                                                    <option selected hidden disabled></option>
                                                                    @foreach ($labs as $labo)
                                                                        <option value={{ $labo->id }}
                                                                            {{ $lab->id === $labo->id ? 'disabled' : '' }}>
                                                                            {{ $labo->nama_laboratorium }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

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

                                        {{-- -------------------------------------------------------------modal migrate barang-------------------------------------------------------- --}}



                                        {{-- -------------------------------------------------------------modal edit barang-------------------------------------------------------- --}}
                                        <div class="modal fade" id="editLabor{{ $loop->iteration }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit labor
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('daftar-laboratorium.update', $lab->kode_laboratorium) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nama_laboratorium" class="form-label">Nama
                                                                    Laboratorium</label>
                                                                <input type="text" class="form-control"
                                                                    id="nama_laboratorium" name="nama_laboratorium"
                                                                    value="{{ $lab->nama_laboratorium }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="kode_laboratorium" class="form-label">Kode
                                                                    Laboratorium</label>
                                                                <input type="text" class="form-control"
                                                                    id="kode_laboratorium" name="kode_laboratorium"
                                                                    value="{{ $lab->kode_laboratorium }}">
                                                            </div>



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

                                        {{-- -------------------------------------------------------------modal edit barang-------------------------------------------------------- --}}


                                        {{-- ----------modal hapus barang----------- --}}
                                        <div class="modal fade" id="hapusLabor{{ $loop->iteration }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                @if ($lab->barangs->count() > 0)
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-light">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus
                                                                Laboratorium
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Laboratorium {{ $lab->nama_laboratorium }} Tidak kosong
                                                                harap lakukan migrasi terlebih dahulu</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#migrateLabor{{ $loop->iteration }}">Migrate
                                                                Laboratorium</button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-light">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus
                                                                Laboratorium
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Hapus data laboratorium {{ $lab->nama_laboratorium }}?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <form
                                                                action="{{ route('daftar-laboratorium.destroy', $lab->kode_laboratorium) }}"
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
                    <p class="text-center fs-4">Laboratorium kosong</p>
                    @endif
                </div>

                {{-- modal tambah laboratorium --}}
                <div class="modal fade in" id="tambahLabor" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah Laboratorium</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('daftar-laboratorium.store') }}">
                                    @csrf
                                    <div class="mb-3  fw-bold">
                                        <label for="nama_laboratorium" class="form-label">Nama laboratorium</label>
                                        <input type="text"
                                            class="form-control @error('nama_laboratorium') is-invalid @enderror"
                                            id="nama_laboratorium" name="nama_laboratorium"
                                            value="{{ old('nama_laboratorium') }}" required>
                                        @error('nama_laboratorium')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3  fw-bold">
                                        <label for="kode_laboratorium" class="form-label">Kode laboratorium</label>
                                        <input type="text"
                                            class="form-control @error('kode_laboratorium') is-invalid @enderror"
                                            id="kode_laboratorium" name="kode_laboratorium"
                                            value="{{ old('kode_laboratorium') }}" required>
                                        @error('kode_laboratorium')
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

                {{-- modal tambah laboratorium --}}
            </div>
        </main>
    </div>
@endsection
