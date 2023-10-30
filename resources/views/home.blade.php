@extends('layout.navbar')
@section('page')
    {{ $page }}
@endsection

@section('content')
    <div class="card text-center shadow">
        <div class="card-header bg-primary fs-3 fw-bold text-white">
            Tata cara peminjaman barang
        </div>
        <div class="card-body d-block p-2" >
            <img src="/image/tatacara.jpg" class="card-img-top img-fluid "
                alt="tatacara" style="min-height: 50vh">
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('pinjamBarang') }}" class="btn btn-lg btn-primary">Pinjam Barang</a>
        </div>
    </div>

    <div class="modal fade" id="cek" tabindex="-1" aria-labelledby="cek" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h5 class="modal-title" id="cek">Cek Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cek-peminjaman') }}">
                        <label class="form-label" for="">Masukan NIM/NIK yang sudah di daftarkan!</label>
                        <div class="input-group ">
                            <input type="text" class="form-control " placeholder="search" name="nim"
                                id="nim" value={{ request('nim') }}>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
