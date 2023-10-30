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
                        $errors->all(' <div class="alert alert-danger alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>'),
                    ) !!}
                @endif
                <div class="card my-4   shadow">
                    <div class="card-header text-white bg-primary fs-4">
                        <i class="fas fa-table me-1"></i>
                        Daftar Barang

                    </div>
                    <div class="card-body table-responsive">
                        @if ($barangs->count())
                            {{-- <div class="d-flex align-items-start mb-2"> --}}

                            <div class="d-inline-flex flex-row-reverse m-1">
                                <form class="" action="<?php echo URL::current(); ?>">
                                    <div class="input-group">
                                        <input type="text" class="form-control border border-primary"
                                            placeholder="search..." name="search" value={{ request('search') }}>
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                            {{-- </div> --}}
                            <table id="datatablesSimple"
                                    class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                    <thead class="bg-primary fs-6">
                                        <tr class="text-white text-center">
                                            <th>No. </th>
                                            <th>Nama Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Milik Lab</th>
                                            <th>Ruang Penyimpanan</th>
                                            <th>Kondisi</th>
                                            <th>Status </th>
                                        </tr>
                                    </thead>
                                <tbody>

                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a class="text-decoration-none text-black text-break"
                                                    href="{{ route('daftar-barang.show', $barang->kode_barang) }}">{{ $barang->nama_barang }}</a>
                                            </td>
                                            <td class="text-break">{{ $barang->kode_barang }}</td>
                                            <td><a class="text-decoration-none text-black"
                                                    href="{{ route('daftar-laboratorium.show', $barang->laboratorium->kode_laboratorium) }}">{{ $barang->laboratorium->nama_laboratorium }}</a>
                                            </td>
                                            <td><a class="text-decoration-none text-black"
                                                    href="{{ route('lokasi-penyimpanan.show', $barang->lokasi_penyimpanan->kode_lokasi) }}">{{ $barang->lokasi_penyimpanan->nama_lokasi }}</a>
                                            </td>
                                            <td>{{ $barang->kondisi }}</td>
                                            <td>{{ $barang->status }}</td>
                                        </tr>
                                        {{-- ----------modal hapus barang----------- --}}
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $barangs->links() }}
                            </div>
                    </div>
                @else
                    <p class="text-center fs-4">Barang kosong</p>
                    @endif
                </div>
            </div>
        </main>
    </div>

@endsection
