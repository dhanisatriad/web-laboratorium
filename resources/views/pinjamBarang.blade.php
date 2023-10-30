@extends('layout.navbar')
@section('page')
    {{ $page }}
@endsection

@section('content')

    @if ($barangs->count())
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="row my-4">
            @if ($errors->any())
                {!! implode(
                    '',
                    $errors->all(' <div class="alert alert-danger alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>'),
                ) !!}
            @endif
            <div class=" mb-3"><a class="text-decoration-none text-dark" href="/"><i class="fa-solid fa-circle-question"></i> Tatacara peminjaman barang</a></div>
            @foreach ($barangs as $barang)
                {{-- {{ $barang }} --}}
                <div class="parents mb-3 col-xl-3 col-md-6">
                    <div class="card shadow-lg bg-primary card-barang">
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
                        <div class="card-body bg-dark text-white container" style="padding-right: 0px;">
                            <div class="container-fluid overflow-auto m-0 p-0" style="height: 110px">
                                <h6><a href="/{{ $barang->kode_barang }}"
                                        class='card-title fw-bolder text-decoration-none text-light'>
                                        {{ $barang->nama_barang }}</a> <br>
                                    Jumlah {{ $jumlahBarang[$barang->nama_barang] }}
                                </h6>
                                <p>
                                    Kondisi: {{ $barang->kondisi }}<br>
                                    Status: {{ $barang->status }}<br>

                                    {{-- {{ $barangs->created_at->diffForHumans() }} --}}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer bg-dark d-flex">
                            <a href="/{{ $barang->kode_barang }}" class="btn btn-sm btn-success">Read more...</a>
                            {{-- <a href="{{ route('pinjam-barang') }}" class="btn btn-primary text-wrap btn-sm">Pinjam Barang</a> --}}
                            <button class="pinjam btn btn-sm btn-success ms-auto" value="{{ $barang->nama_barang }}"
                                onclick="test(this)">Pinjam Barang</button>
                        </div>
                    </div>
                </div>
            @endforeach


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


            <div class="modal fade in" id="pinjamBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title fw-bold" id="staticBackdropLabel">Pinjam Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('peminjam.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 fw-bold col-6">
                                    <label for="level" class="form-label">Status <b class="text-danger">*</b></label>
                                    <select class="form-select border-dark @error('level') is-invalid @enderror"
                                        id="level" name="level" required>
                                        <option value="Mahasiswa">
                                            Mahasiswa
                                        </option>
                                        <option value="Dosen">
                                            Dosen
                                        </option>
                                    </select>
                                    @error('level')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3  fw-bold">
                                    <label for="nama_peminjam" class="form-label">Nama <b class="text-danger">*</b></label>
                                    <input type="text"
                                        class="form-control border-dark @error('nama_peminjam') is-invalid @enderror"
                                        id="nama_peminjam" maxlength="255" name="nama_peminjam"
                                        value="{{ old('nama_peminjam') }}" required>
                                    <input type="hidden" maxlength="255" name="kode_peminjaman" id="kode_peminjaman"
                                        value="{{ old('kode_peminjaman') }}">
                                    @error('nama_peminjam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3  fw-bold">
                                    <label for="keperluan" class="form-label">Keperluan <b
                                            class="text-danger">*</b></label>
                                    <input type="text"
                                        class="form-control border-dark @error('keperluan') is-invalid @enderror"
                                        id="keperluan" name="keperluan" value="{{ old('keperluan') }}" maxlength="255"
                                        required>
                                        <p class="text-secondary fw-normal">Contoh: Penelitian, Tugas Akhir</p>
                                    @error('keperluan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3  fw-bold">
                                    <label for="email_peminjam" class="form-label">Email <b
                                            class="text-danger">*</b></label>
                                    <input type="email"
                                        class="form-control border-dark @error('email_peminjam') is-invalid @enderror"
                                        id="email_peminjam" maxlength="255" name="email_peminjam"
                                        value="{{ old('email_peminjam') }}" required>
                                    @error('email_peminjam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3  fw-bold">
                                    <label for="nim" class="form-label">NIM/NIK <b class="text-danger">*</b></label>
                                    <input type="text"
                                        class="form-control border-dark @error('nim') is-invalid @enderror" id="nim"
                                        name="nim" value="{{ old('nim') }}" maxlength="255" required>
                                    @error('nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 fw-bold">
                                    <label for="fakultas" class="form-label">Fakultas <b
                                            class="text-danger">*</b></label>
                                    <select class="form-select border-dark @error('fakultas') is-invalid @enderror"
                                        id="fakultas" name="fakultas" required>
                                        @foreach ($fakultases as $fakultas)
                                            <option value="{{ $fakultas->nama_fakultas }}" rel="{{ $fakultas->id }}">
                                                {{ $fakultas->nama_fakultas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fakultas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 fw-bold">
                                    <label for="jurusan" class="form-label">Prodi <b class="text-danger">*</b></label>
                                    <select class="form-select border-dark @error('jurusan') is-invalid @enderror"
                                        id="jurusan" name="jurusan" required>
                                        @foreach ($fakultases as $fakultas)
                                            <option class="dropdown-header" disabled>{{ $fakultas->nama_fakultas }}
                                            </option>
                                            @foreach ($fakultas->jurusans as $jurusan)
                                                <option class="{{ $fakultas->id }}"
                                                    value="{{ $jurusan->nama_jurusan }}">{{ $jurusan->nama_jurusan }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('jurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 fw-bold">
                                    <label for="kontak" class="form-label">HP/WA <b class="text-danger">*</b></label>
                                    <input type="text"
                                        class="form-control border-dark @error('kontak') is-invalid @enderror"
                                        id="kontak" name="kontak" value="{{ old('kontak') }}" required>
                                    @error('kontak')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 fw-bold row g-md-1">
                                    <div class="col-4 col-lg-6">
                                        <label class="form-label" for="barang">Barang <b
                                                class="text-danger">*</b></label>
                                        @php
                                            $uniq = $namaBarang->unique('nama_barang');
                                        @endphp
                                        <div id="pilih_barang">
                                            <select class="inputBarang selectpicker" data-width='100%'
                                                data-dropup-auto="false" data-style="border border-dark" data-size="10"
                                                data-live-search="true" id="barang1">
                                                @foreach ($uniq as $namaB)
                                                    <option class="barang" value="{{ $namaB->nama_barang }}">
                                                        {{ $namaB->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" id="Barang" name="barang">
                                    </div>
                                    <div class="col-3 col-lg-2">
                                        <label class="form-label" for="jumlah1">Jumlah</label>
                                        <div id="pilih_jumlah">
                                            <input class="form-control border-dark inputJumlah" type="number"
                                                min="1" value="1" id="jumlah1">
                                        </div>
                                    </div>
                                    <div class="col-2 col-lg-1">
                                        <label class="form-label">Hapus</label>
                                        <div id="pilih_hapus">
                                            <div id="1" onclick="remove(this)"
                                                class="btn btn-danger form-control disabled" value="1"><i
                                                    class="fa-solid fa-trash "></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 col-lg-2 ms-auto">
                                        <div onclick="addButton()" type="button" class="btn btn-success">tambah</div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal Peminjaman <b
                                            class="text-danger">*</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary fw-bold text-white border-dark">Dari</div>
                                        <input type="text" id="datepicker" name="tanggal_pinjam"
                                            value="{{ old('tanggal_pinjam') }}"
                                            class="form-control  border-dark @error('tanggal_pinjam') is-invalid @enderror"
                                            required>
                                        @error('tanggal_pinjam')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="input-group-text bg-primary fw-bold text-white  border-dark">Sampai
                                        </div>
                                        <input type="text" id="datepicker2" name="tanggal_kembali"
                                            value="{{ old('tanggal_kembali') }}"
                                            class="form-control border-dark @error('tanggal_kembali') is-invalid @enderror"
                                            required>
                                        @error('tanggal_kembali')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3  fw-bold dosen">
                                    <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing <b
                                            class="text-danger">*</b></label>
                                    <input type="text"
                                        class="form-control border-dark @error('dosen_pembimbing') is-invalid @enderror"
                                        id="dosen_pembimbing" name="dosen_pembimbing"
                                        value="{{ old('dosen_pembimbing') }}" maxlength="255" required>
                                    @error('dosen_pembimbing')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3  fw-bold dosen">
                                    <label for="nip_dosen" class="form-label">NIP/NIK Dosen Pembimbing <b
                                            class="text-danger">*</b></label>
                                    <input type="text"
                                        class="form-control border-dark @error('nip_dosen') is-invalid @enderror"
                                        id="nip_dosen" name="nip_dosen" value="{{ old('nip_dosen') }}" maxlength="255"
                                        required>
                                    @error('nip_dosen')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="file_name" class="form-label fw-bold">Surat Peminjaman <b
                                            class="text-danger">*</b></label>
                                    <input class="form-control border-dark @error('file_name') is-invalid @enderror"
                                        type="file" id="file_name" accept=".pdf,.doc,.docx" name="file_name"
                                        required>
                                    @error('file_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <a id="download-surat" href=""></a>
                                </div>
                                <br>
                                <p class="fw-bold"><b class="text-danger">*</b> = Harus Diisi</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" id="input" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $barangs->links() }}
            </div>
        </div>
    @else
        <p class="text-center fs-4">Barang kosong</p>
    @endif




    <script>
        const nama_peminjam = document.querySelector('#nama_peminjam');
        const kode_peminjaman = document.querySelector('#kode_peminjaman');
        nama_peminjam.addEventListener('change', function() {
            fetch('/peminjam/checkSlug?nama_peminjam=' + nama_peminjam.value)
                .then(response => response.json())
                .then(data => kode_peminjaman.value = data.kode)
        });
    </script>


    <script>
        $(document).ready(function() {

            var checkLevel = function() {
                var linkDownload = $('#download-surat');
                if ($('#level').val() == 'Dosen') {
                    linkDownload.html('Dowload Template Surat Peminjaman Dosen');
                    linkDownload.attr('href', "https://docs.google.com/uc?id=1bSQGpmyUWZ-zJ9FlPoTyWVrEBSYmchfY&export=download");
                    $('.dosen').hide().prop('disabled', true);
                    $('#dosen_pembimbing').prop('required', false).val(null);
                    $('#nip_dosen').prop('required', false).val(null);
                } else {
                    linkDownload.html('Dowload Template Surat Peminjaman Mahasiswa');
                    linkDownload.attr('href', "https://docs.google.com/uc?id=110vA5xuM0nfZ7EjWnGWqJO_arBIzbqKP&export=download");
                    $('.dosen').show().prop('disabled', false);
                    $('#dosen_pembimbing').prop('required', true)
                    $('#nip_dosen').prop('required', true)
                }
            };

            $('#level').change(checkLevel);
            $('#pinjamBarang').on('shown.bs.modal', checkLevel);



            var $fakultas = $('select[name=fakultas]'),
                $jurusan = $('select[name=jurusan]');

            $fakultas.change(function() {

                var $this = $(this).find(':selected'),
                    rel = $this.attr('rel');

                // Hide all
                $jurusan.find("option").hide();

                // Find all matching accessories
                // Show all the correct accesories
                // Select the first accesory
                $set = $jurusan.find('option.' + rel);
                $set.show().first().prop('selected', true);

            });
            $jurusan.change(function() {

                var $this = $(this).find(':selected'),
                    rel = $this.attr('class');
                // console.log(rel);

                // Hide all
                $set = $fakultas.find(`[rel= ${rel}]`);
                $set.prop('selected', true);

            });


            $('#datepicker').datepicker({
                format: 'dd-mm-yyyy',
                startDate: '+d',
                todayHighlight: true,
                disableTouchKeyboard: true,
                clearBtn: true,
            });

            $('#datepicker2').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                startDate: '+d',
                disableTouchKeyboard: true,
                clearBtn: true,
            });

        });
        $('#datepicker').on("change", function() {
            var startVal = $('#datepicker').val();
            $('#datepicker2').data('datepicker').setStartDate(startVal);
        });
        $('#datepicker2').on("change", function() {
            var startVal = $('#datepicker2').val();
            $('#datepicker').data('datepicker').setEndDate(startVal);
        });
    </script>

    <script>
        function test(ele) {
            var nasi = ele.value;
            console.log(nasi);
            $(".barang").removeAttr("selected");
            $('.barang').filter(function() {
                return this.value == nasi
            }).attr("selected", "selected");
            $('.filter-option-inner-inner').html(nasi)
            $('#pinjamBarang').modal('show');
        };
    </script>

    <script>
        function remove(ele) {
            var numb = document.getElementById("pilih_barang").childElementCount;
            if (numb > 1) {
                var barang = $("#barang" + ele.id).parent();
                var jumlah = $("#jumlah" + ele.id);
                var hapus = $(ele)
                barang.remove();
                // barangbtn.remove()
                jumlah.remove();
                hapus.remove();
            } else {
                document.getElementById(ele.id).classList.add("disabled")
            }
        }
    </script>

    <script>
        var arr = [];
        var b = 1;

        $("#input").on("click", function() {

            $("select.inputBarang").each(function(index, val) {
                var from = $(this).val();
                if (arr[index] === undefined) {
                    arr[index] = {
                        barang: from
                    };
                } else {
                    arr[index].barang = from;
                }
            });
            $(".inputJumlah").each(function(index, val) {
                var to = $(this).val();
                if (arr[index] === undefined) {
                    arr[index] = {
                        to: to
                    };
                } else {
                    arr[index].jumlah = to;
                }
                // console.log(n);

            });
            // console.log(arr);
            $("#Barang").val(JSON.stringify(arr));
        });

        function addButton() {

            $("#pilih_hapus>div.disabled").removeClass("disabled");
            var element = document.createElement("select");
            b = ++b
            element.id = 'barang' + b;
            element.className = "inputBarang mt-1";
            // element.attr('data-style', 'border border-dark');
            // element.attr('data-live-search', 'true');

            var option = document.createElement("option");
            <?php
            $uniq = $namaBarang->unique('nama_barang');
            foreach ($uniq as $namaB): ?>
            var option = document.createElement("option");
            option.value = '<?php echo $namaB->nama_barang; ?>';
            option.innerHTML = '<?php echo $namaB->nama_barang; ?>';
            element.appendChild(option);
            <?php endforeach ?>
            $("#pilih_barang").append(element);
            $('.inputBarang').attr({
                'data-width': '100%',
                'data-style': 'border border-dark',
                'data-live-search': 'true',
                'data-size': '10',
                'data-dropup-auto': 'false',
            });
            $('.inputBarang').selectpicker();



            var jumlah = document.createElement("input");
            jumlah.id = 'jumlah' + b;
            jumlah.className = "form-control mt-1 border-dark inputJumlah";
            jumlah.type = "number";
            jumlah.min = "1";
            jumlah.value = "1";
            $("#pilih_jumlah").append(jumlah);

            var hapus = document.createElement("div");
            hapus.id = b;
            hapus.className = "btn btn-danger form-control mt-1";
            hapus.addEventListener("click", function() {
                remove(this)
            });
            var icon = document.createElement("i");
            icon.className = "fa-solid fa-trash disabled";
            hapus.appendChild(icon);
            $("#pilih_hapus").append(hapus);

            // $('.inputBarang').each(function() {
            //         var dropdownParent = $(document.body);
            //         if ($(this).parents('.modal.in:first').length !== 0)
            //             dropdownParent = $(this).parents('.modal.in:first');
            //         $(this).select2({
            //             dropdownParent: dropdownParent,
            //             theme: "bootstrap-5"
            //         });
            //     });

            // $(".inputBarang").each(function() {
            // allVals.push($(this).val());
            // });

            // $("#inputBarang").val(allVals);

        };
    </script>



@endsection
