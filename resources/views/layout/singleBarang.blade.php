@extends('layout.navbar')
@section('page')
    {{ $page }}
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            @if ($errors->any())
                {!! implode(
                    '',
                    $errors->all(' <div class="alert alert-danger alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                            </div>'),
                ) !!}
            @endif
            {{-- card --}}
            <div class="px-4 mb-5 d-flex justify-content-center row">
                <div class="col-sm-12 col-md-10">
                    <div class="card my-4 border border-dark">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center  bg-primary">
                                <div class="pt-3 pb-3 mx-auto d-block p-2">
                                    @if ($barang->gambar_barang)
                                        <img src="{{ asset('storage/' . $barang->gambar_barang) }}"
                                            class="card-img-top img-fluid fit-image" alt="{{ $barang->nama_barang }}">
                                    @else
                                        @if ($barang->laboratorium->id == 1)
                                            <img src="/image/placeholder/{{ mt_rand(1, 2) }}.png"
                                                class="card-img-top img-fluid fit-image" alt="{{ $barang->nama_barang }}">
                                        @elseif ($barang->laboratorium->id == 2)
                                            <img src="/image/placeholder/{{ mt_rand(3, 4) }}.png"
                                                class="card-img-top img-fluid fit-image" alt="{{ $barang->nama_barang }}">
                                        @elseif ($barang->laboratorium->id == 3)
                                            <img src="/image/placeholder/{{ mt_rand(5, 6) }}.png"
                                                class="card-img-top img-fluid fit-image" alt="{{ $barang->nama_barang }}">
                                        @elseif ($barang->laboratorium->id == 4)
                                            <img src="/image/placeholder/{{ mt_rand(7, 8) }}.png"
                                                class="card-img-top img-fluid fit-image" alt="{{ $barang->nama_barang }}">
                                        @else
                                            <img src=/image/placeholder/9.png class="card-img-top img-fluid fit-image"
                                                alt="{{ $barang->nama_barang }}">
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 d-flex">
                                <div class="card-body flex-fill bg-dark text-white table-responsive">
                                    <table class="table text-white">
                                        <tbody>
                                            <tr>
                                                <th>Nama Barang: </th>
                                                <td>{{ $barang->nama_barang }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah:</th>
                                                <td>{{ $jumlahBarang }}</td>
                                            </tr>
                                            <tr>
                                                <th>kondisi:</th>
                                                <td>{{ $barang->kondisi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Part:</th>
                                                <td>{!! $barang->part !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi:</th>
                                                <td>{!! $barang->deskripsi !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- <h6 class="card-text">Milik: {{ $barang->laboratorium->nama_laboratorium }}</h6>
                                <h6 class="card-text">Status: {{ $barang->status }}</h6>
                                <h6 class="card-text">kondisi: {{ $barang->kondisi }}</h6>
                                <h6 class="card-text">Deskripsi:<br> {!! $barang->deskripsi !!}</h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </main>
    </div>
@endsection
