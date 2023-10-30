@extends('layout.navbar')
@section('page')
    {{ $page }}
@endsection

@section('content')
    {{-- @php
    DD($nims);
@endphp --}}
    @if ($nims->count())
        <div class="card my-4  border border-dark">
            <div class="card-header text-white bg-primary fs-4">
                <i class="fas fa-table me-1"></i>
                Daftar Permohonan

            </div>
            <div class="card-body table-responsive text-nowrap">
                @foreach ($nims as $nim)
                    <table id="datatablesSimple"
                        class="table dataTable-table rounded rounded-4 table-bordered table-hover table-striped mt-3 mb-0">
                        <thead
                            class="text-white bg-primary @if ($nim->status == 'Dikonfirmasi') {{ 'bg-success' }} @elseif ($nim->status == 'Ditolak' || $nim->status == 'Terlambat') {{ 'bg-danger' }} @endif">
                            <tr>
                                <th>No.</th>
                                <th>Nama </th>
                                <th>NIM/NIK</th>
                                <th>kode Peminjaman</th>
                                <th>Tanggal peminjaman</th>
                                <th>Tanggal Pengambalian</th>
                                <th>status</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class=" text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td><a class="text-decoration-none text-black text-break">{{ $nim->nama_peminjam }}</a>
                                </td>
                                <td><a class="text-decoration-none text-black text-break">{{ $nim->nim }}</a>
                                </td>
                                <td class="text-break">{{ $nim->kode_peminjaman }}</td>
                                <td><a class="text-decoration-none text-black">{{ $nim->tanggal_pinjam }}</a>
                                </td>
                                <td><a class="text-decoration-none text-black">{{ $nim->tanggal_kembali }}</a>
                                </td>
                                <td>{{ $nim->status }}</td>
                                @php
                                    if ($nim->status == 'Dikonfirmasi') {
                                        $jumlahbarang = $nim->barangs->groupBy('nama_barang')->map(function ($item) {
                                            return $item->count();
                                        });
                                        $ayam = $nim->barangs->groupBy('nama_barang');
                                        $nasi = array_keys($ayam->toarray());
                                    } else {
                                        $nasi = json_decode($nim->barang, true);
                                    }

                                @endphp

                                <td class="p-0">
                                    <div class=" table-responsive">
                                        <table class="table table-bordered m-0">
                                            <tbody>

                                                @foreach ($nasi as $namabarang)
                                                    <tr>
                                                        <td>
                                                            @php
                                                                if ($nim->status == 'Dikonfirmasi') {
                                                                    $b = $namabarang;
                                                                } else {
                                                                    $barang = collect($namabarang);
                                                                    $b = $barang->get('barang');
                                                                }
                                                            @endphp
                                                            {{ $b }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td class="p-0">
                                    <table class="table table-bordered m-0">
                                        <tbody>
                                            @if ($nim->status == 'Dikonfirmasi')
                                                @foreach ($jumlahbarang as $jumlah)
                                                    <tr>
                                                        <td>
                                                            {{ $jumlah }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach ($nasi as $namabarang)
                                                    <tr>
                                                        <td>
                                                            @php
                                                                // dd($namabarang);
                                                                $barang = collect($namabarang);
                                                                if ($nim->status == 'Dikonfirmasi') {
                                                                    $j = $barang->get('nama_barang');
                                                                } else {
                                                                    $j = $barang->get('jumlah');
                                                                }
                                                            @endphp
                                                            {{ $j }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif



                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    @if ($nim->status == 'Dikonfirmasi')
                        *Pastikan untuk membawa surat izin dan KTM/KTP yang anda daftarkan untuk dapat melakukan
                        pengambilan barang</p>
                    @endif
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $nims->links() }}
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
    @else
        <p class="text-center fs-4">permohonan dengan NIM/NIK yang beersangkutan tidak di temukan</p>
    @endif
@endsection
