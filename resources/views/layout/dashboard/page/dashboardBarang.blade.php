@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            @if ($errors->any())
                {!! implode(
                    '',
                    $errors->all(' <div class="alert alert-danger alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                            </div>'),
                ) !!}
            @endif
            @php
                // dd($barang)
            @endphp
            {{-- card --}}
            <div class="container-fluid px-4 mb-5 d-flex justify-content-center">
                <div class="card my-4  shadow w-75 ">
                    {{-- header --}}
                    <div class="card-header fs-1 bg-primary d-flex text-light text-center p-0">
                        <div class="flex-grow-1">
                            {{ $barang->nama_barang }}
                        </div>

                        <button class="btn btn-success rounded-end px-3 " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li type="button" class="dropdown-item"data-bs-toggle="modal"
                                data-bs-target="#duplicateBarang">
                                <i class="fa-regular fa-copy me-2"></i>Duplicate
                            </li>
                            <li type="button"
                                class="dropdown-item @if ($barang->status == 'Dipinjamkan' || $barang->status == 'Dikonfirmasi') {{ 'disabled' }} @endif "
                                data-bs-toggle="modal" data-bs-target="#editBarang">
                                <i class="fa-regular fa-pen-to-square me-2"></i>Edit
                            </li>
                            <li>
                                <form method="POST" action="{{ route('print') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $barang->id }}">
                                    <button type="submit" class="dropdown-item btn"><i
                                            class="fa-solid fa-print me-2"></i>Print</button>
                                </form>
                            </li>
                            <li type="button"
                                class="dropdown-item @if ($barang->status == 'Dipinjamkan' || $barang->status == 'Dikonfirmasi') {{ 'disabled' }} @endif"
                                data-bs-toggle="modal" data-bs-target="#hapusBarang">
                                <i class="fa-regular fa-rectangle-xmark me-2"></i>Hapus
                            </li>
                        </ul>

                    </div>
                    {{-- header --}}

                    {{-- body --}}
                    <div class="row">
                        <div class="col-md-6">
                            @if ($barang->gambar_barang)
                                <div class="pt-3 pb-3 mx-auto d-block p-2" style="max-width: 250px">
                                    <img src="{{ asset('storage/' . $barang->gambar_barang) }}"
                                        class="card-img-top img-fluid img-thumbnail shadow"
                                        alt="{{ $barang->nama_barang }}">
                                </div>
                            @else
                                <div class="pt-3 p-2 mx-auto" style="max-width: 200px">
                                    @if ($barang->laboratorium_id == 1)
                                        <img src="/image/placeholder/{{ mt_rand(1, 2) }}.png" class="card-img-top"
                                            alt="{{ $barang->nama_barang }}">
                                    @elseif ($barang->laboratorium_id == 2)
                                        <img src="/image/placeholder/{{ mt_rand(3, 4) }}.png" class="card-img-top"
                                            alt="{{ $barang->nama_barang }}">
                                    @elseif ($barang->laboratorium_id == 3)
                                        <img src="/image/placeholder/{{ mt_rand(5, 6) }}.png" class="card-img-top"
                                            alt="{{ $barang->nama_barang }}">
                                    @elseif ($barang->laboratorium_id == 4)
                                        <img src="/image/placeholder/{{ mt_rand(7, 8) }}.png" class="card-img-top"
                                            alt="{{ $barang->nama_barang }}">
                                    @else
                                        <img src=/image/placeholder/9.png class="card-img-top"
                                            alt="{{ $barang->nama_barang }}">
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="pt-3 pb-3 mx-auto d-block" style="max-width: 200px">
                                {{ QrCode::size(200)->generate($barang->kode_barang) }}
                            </div>
                        </div>
                    </div>
                    <span class="border-bottom border-dark"></span>
                    <div class="card-body bg-info table-responsive">
                        <table class="table rounded rounded-4 table-striped table-hover border-info bg-white text-dark">
                            <tbody>
                                <tr>
                                    <th class="col-3">Nama Barang: </th>
                                    <td>{{ $barang->nama_barang }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <th class="col-3">Jumlah Barang: </th>
                                    <td><a class="text-decoration-none text-black text-break"
                                            href="/dashboard/daftar-barang?search={{ $barang->nama_barang }}">{{ $jumlahBarang }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-3">kode Barang: </th>
                                    <td>{{ $barang->kode_barang }}</td>
                                </tr>
                                <tr>
                                    <th>Milik:</th>
                                    <td>{{ $barang->laboratorium->nama_laboratorium }}</td>
                                </tr>
                                <tr>
                                    <th>Ruang Penyimpanan:</th>
                                    <td>{{ $barang->lokasi_penyimpanan->nama_lokasi }}</td>
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
                    </div>
                    {{-- body --}}

                </div>

            </div>
            {{-- card --}}

            {{-- ----------modal edit barang----------- --}}

            <div class="modal fade in" id="editBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form" method="post" action="{{ route('barang.update', $barang->kode_barang) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama
                                        Barang</label>
                                    <input type="text" class="form-control" maxlength="255" id="nama_barangE"
                                        name="nama_barang" value="{{ $barang->nama_barang }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="laboratorium_id">Nama
                                        laboratorium</label>
                                    <select class="form-select" id="laboratorium_idE" name="laboratorium_id">
                                        @foreach ($labs as $lab)
                                            <option value={{ $lab->id }}
                                                {{ $barang->laboratorium_id === $lab->id ? 'selected' : '' }}>
                                                {{ $lab->nama_laboratorium }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="inputGroupSelect02">Nama
                                        Ruang
                                        penyimpanan</label>
                                    <select class="form-select" id="inputGroupSelect02" name="lokasi_penyimpanan_id">
                                        @foreach ($lokasis as $ruang)
                                            <option value={{ $ruang->id }}
                                                {{ $barang->lokasi_penyimpanan_id === $ruang->id ? 'selected' : '' }}>
                                                {{ $ruang->nama_lokasi }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode
                                        Barang</label>
                                    <input type="text" maxlength="25" class="form-control" id="kode_barangE"
                                        name="kode_barang" value="{{ $barang->kode_barang }}">
                                    <p class="fw-lighter">*Double Click untuk membuat kode barang otomatis</p>
                                    <p id="sadInE"></p>
                                </div>
                                <label class="form-label">Kondisi</label>

                                <div class="input-group mb-3">
                                    <div class="form-check form-check-inline ms-2">
                                        <input class="form-check-input" type="radio" name="kondisi"
                                            id="exampleRadios1" value="Bagus"
                                            {{ $barang->kondisi == 'Bagus' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Bagus
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kondisi"
                                            id="exampleRadios3" value="Rusak Ringan"
                                            {{ $barang->kondisi == 'Rusak Ringan' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios3">
                                            Rusak Ringan
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kondisi"
                                            id="exampleRadios2" value="Rusak"
                                            {{ $barang->kondisi == 'Rusak' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Rusak
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar_barang" class="form-label fw-bold">Gambar Barang</label>
                                    @if ($barang->gambar_barang)
                                        <input type="hidden" id="old_image" name="old_image"
                                            value="{{ $barang->gambar_barang }}">

                                        <input type="hidden" id="hapus_gambar_input" name="hapus_gambar_input"
                                            value="">
                                        <br>
                                        <div id="hapus-gambar">
                                            <span class="badge bg-danger m-1" style="cursor: pointer">hapus barang</span>
                                        <img class="img_prevE img-fluid mb-3 img-fluid img-thumbnail border-dark col-sm-5 d-block"
                                            src="{{ asset('storage/' . $barang->gambar_barang) }}">
                                        </div>
                                    @else
                                        <img class="img_prevE img-fluid mb-3 col-sm-5 d-block">
                                    @endif
                                    <input class="form-control border-dark @error('gambar_barang') is-invalid @enderror"
                                        type="file" id="gambar_barangE" accept="image/png, image/jpeg"
                                        onchange="prevImgE()" name="gambar_barang">
                                    @error('gambar_barang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="part" class="form-label fw-bold">Part</label>
                                    <input id="part" type="hidden" name="part" value="{{ $barang->part }}">
                                    <trix-editor input="part">
                                    </trix-editor>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                    <input id="deskripsi" type="hidden" name="deskripsi"
                                        value="{{ $barang->deskripsi }}">
                                    <trix-editor input="deskripsi">
                                    </trix-editor>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ----------modal edit barang----------- --}}

            {{-- ----------modal hapus barang----------- --}}
            <div class="modal fade" id="hapusBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Hapus data barang {{ $barang->nama_barang }}?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                            <form action="{{ route('barang.destroy', $barang->kode_barang) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn bg-danger" id="hapus">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ----------modal hapus barang----------- --}}

            <div class="modal fade" id="duplicateBarang" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="staticBackdropLabel">Duplicate Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('daftar-barang.store') }}">
                                @csrf
                                <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                                <input type="hidden" name="laboratorium_id" value="{{ $barang->laboratorium_id }}">
                                <input type="hidden" name="lokasi_penyimpanan_id"
                                    value="{{ $barang->lokasi_penyimpanan_id }}">
                                <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">
                                <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">
                                <input type="hidden" name="gambar_barang" value="{{ $barang->gambar_barang }}">
                                <input type="hidden" name="deskripsi" value="{{ $barang->deskripsi }}">
                                <input type="hidden" name="part" value="{{ $barang->part }}">
                                {{-- <input id="part" type="hidden"
                                    value="{{ $barang->part }}"
                                        name="part"> --}}
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        min="1">
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
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

    <script>
        $('#editBarang').on('shown.bs.modal', function(event) {
            $('#hapus_gambar_input').val(null);
            $('#hapus-gambar').show();
            $('#hapus-gambar').click(function() {
                $(this).hide()
                $('#hapus_gambar_input').val(true);
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




        var createKode = function() {
            var nama_barang = $('#nama_barangE').val();
            var laboratorium = $('#laboratorium_idE').val();

            // console.log(nama_barang);
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
                        // $('#sadIn').html(
                        //     'kode barang yang di inputkan salah');
                        // $('#input_scanIn').val("").focus();
                    }
                });
        };
        $('#kode_barangE').dblclick(createKode);
        $('#nama_barangE').change(createKode);
        $('#laboratorium_idE').change(createKode);
    </script>
@endsection
