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
                <div class="card my-4  shadow">
                    <div class="card-header text-white fw-bold bg-primary fs-4">
                        <i class="fas fa-table me-1"></i>
                        Tambahkan Barang Rusak

                    </div>
                    <div class="card-body table-responsive">
                        @if ($barangs->count())
                            {{-- <div class="d-flex align-items-start mb-2"> --}}

                            <input type="checkbox" class="btn-check" id="master" autocomplete="off">
                            <label class="btn btn-primary m-1" for="master">select all</label>

                            <button class="btn btn-primary add_all m-1">Add
                                Selected</button>


                            <select class="btn btn-primary" name="kondisi" id="kondisi_select">
                                <option value="Rusak">Rusak</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                            </select>

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
                                        <th>Select</th>
                                        <th class="thShort" style="min-width: 85px">No. <i
                                                class="short ms-2 fa-solid fa-sort"></i></th>
                                        <th style="min-width: 120px">Nama Barang</th>
                                        <th style="min-width: 120px">Kode Barang</th>
                                        <th class="thShort">Milik Lab <i class="short ms-3 fa-solid fa-sort"
                                                style="cursor: pointer"></i></th>
                                        <th class="thShort" style="min-width: 160px">Lokasi Penyimpanan <i
                                                class="short ms-3 fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th class="thShort" style="min-width: 110px">Kondisi <i
                                                class="short ms-3 fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th class="thShort">Status <i class="short ms-3 fa-solid fa-sort"
                                                style="cursor: pointer"></i></th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($barangs as $barang)
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

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $barangs->links() }}
                            </div>
                            {{-- -------------------------------------------------------------modal migrate labor-------------------------------------------------------- --}}

                            {{-- -------------------------------------------------------------modal migrate labor-------------------------------------------------------- --}}

                            {{-- -------------------------------------------------------------modal migrate ruang-------------------------------------------------------- --}}

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
                                        <div class="modal-body" id="jumlahAdd">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form method="POST" action="{{ route('mutiCheckInRusak') }}">
                                                @csrf
                                                <input type="hidden" name="kondisi" id="kondisi">
                                                <input type="hidden" name="ids" id="addId">
                                                <input type="hidden" name="jumlah" id="jumlah">
                                                <button class="btn btn-primary">Add Selected</button>
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



            </div>
        </main>
    </div>



    <script>
        $(document).ready(function() {

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


            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                    $(".sub_chk[disabled]").prop('checked', false);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            $('.add_all').on('click', function(e) {
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var join_selected_values = allVals.join(",");
                    var jumlah = allVals.length;
                    var status = $('#kondisi_select').val();
                    // console.log(jumlah);
                    $("#jumlahAdd").html(
                        `Apakah anda yakin untuk menambahkan ${jumlah} barang ke daftar barang rusak?`);
                    $('#kondisi').val(status);
                    $("#jumlah").val(jumlah);
                    $('#addId').val(join_selected_values);
                    $('#modalyakin').modal('show')
                }
            });

        });
    </script>

@endsection
