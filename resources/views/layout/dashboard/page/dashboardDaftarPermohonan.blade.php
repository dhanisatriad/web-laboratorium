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
                        Daftar Permohonan
                    </div>

                    <div class="card-body table-responsive">
                        <div class=" mb-3">
                            <a  href="" class="text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#help"><i
                                    class="fa-solid fa-circle-question"></i> Help</a>
                        </div>
                        @if ($permohonans->count())
                            <table id="datatablesSimple"
                                class="table dataTable-table table-hover table-striped mt-2 rounded rounded-4 overflow-hidden">
                                <thead class="bg-primary fs-6">
                                    <tr class="text-white text-center">
                                        <th class="thShort" style="min-width: 80px">No. <i class="short  ms-3 text-end fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th class="thShort" style="min-width: 100px">Nama <i class="short  ms-3 text-right fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th>NIM/NIK</th>
                                        <th>Kontak</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Tanggal Mulai Peminjaman</th>
                                        <th>Tanggal Selesai Peminjaman</th>
                                        <th class="thShort" style="min-width: 100px">Status  <i class="short  ms-3 fa-solid fa-sort" style="cursor: pointer"></i></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permohonans as $permohonan)
                                        <tr class="clickable-row text-center"
                                            data-href="{{ route('daftar-client.show', $permohonan->kode_peminjaman) }}"
                                            style="cursor: pointer">
                                            <td>
                                                {{ $loop->iteration }}</td>
                                            <td>
                                                {{ $permohonan->nama_peminjam }}
                                            </td>
                                            <td>
                                                {{ $permohonan->nim }}</td>

                                            <td>
                                                {{ $permohonan->kontak }}</td>
                                            <td>
                                                {{ $permohonan->kode_peminjaman }}
                                            </td>

                                            <td>{{ date('d-m-Y', strtotime($permohonan->tanggal_pinjam)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($permohonan->tanggal_kembali)) }}</td>
                                            <td class="@if ($permohonan->status == 'Selesai*' || $permohonan->status == 'Ditolak') {{ 'bg-danger text-white' }} @endif">{{ $permohonan->status }}</td>
                                            <td class="delete"><button class="delete-permohonan btn btn-sm btn-danger m-1"
                                                    data-id="{{ $permohonan->id }}"
                                                    @if ($permohonan->status != 'Selesai' && $permohonan->status != 'Ditolak') {{ 'disabled' }} @endif><i
                                                        class="fa-solid
                                                    fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $permohonans->links() }}
                            </div>
                        @else
                            <p class="text-center fs-4">Permohonan kosong</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal fade" id="hapusPermohonan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Barang
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Hapus data barang ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button class="btn bg-danger" id="hapus"
                                data-url="{{ url('/dashboard/daftar-client/delete') }}">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="help" aria-hidden="true" data-bs-backdrop="static"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Help</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <button class="btn btn-primary m-1" data-bs-target="#help2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Tatacara peminjaman barang</button>

                            <button class="btn btn-primary m-1" data-bs-target="#help3" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Tatacara pengembalian barang</button>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="help2" aria-hidden="true" data-bs-backdrop="static"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Tatacara Peminjaman barang
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column justify-content-center">

                            <div class="d-flex flex-column mb-3 align-items-center">
                                <div>
                                    <p class="text-center">Pastikan peminjam Membawa KTM yang di daftarkan dan surat permohonan peminjman barang</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Pilih nama peminjam</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Pastikan status peminjam sudah "Dikonfirmasi"</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p class="text-center">Klik menu peminjaman barang dan scan kode qr barang yang telah di
                                        pilih oleh aplikasi</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Barang berhasil dipinjamkan</p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="help3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel3" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="staticBackdropLabel">Tatacara Pengembalian Barang
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column justify-content-center">

                            <div class="d-flex flex-column mb-3 align-items-center">
                                <div>
                                    <p class="text-center">Pastikan Peminjam membawa KTM yang di daftarkan dan surat
                                        permohonan peminjaman barang</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Pilih nama peminjam</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p class="text-center">Cek kodisi barang yang dikembalikan</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p class="text-center">Klik menu pengambalian barang dan scan kode qr barang yang dikembalikan dan ganti satus barang jika ditemukan barang yang rusak atau rusak ringan</p>
                                </div>
                                <div>
                                    <h4><i class="fa-solid fa-arrow-down"></i></h4>
                                </div>
                                <div>
                                    <p>Barang berhasil dikembalikan</p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        </div>
                    </div>
                </div>



            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {

            // $('#datatablesSimple').bootstrapTable({
            //     shorting: true
            // })


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



            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            }).children('.delete').click(function(e) {
                return false;
            });
            $(".delete-permohonan").click(function() {
                var bruh = $(this).attr('data-id');
                $('#hapusPermohonan').modal('show');
                $('#hapusPermohonan').on('shown.bs.modal', function(event) {
                    // $('#hapus').attr("data-url", "{{ url('/dashboard/daftar-client/delete') }}");
                    $('#hapus').attr("data-id", bruh);
                });
            });

            $('#hapus').on('click', function(e) {
                var id = $(this).attr('data-id');
                if (id == '') {
                    alert("Please select row.");
                } else {
                    // console.log(id);
                    $.ajax({

                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'id=' + id,
                        success: function(data) {
                            if (data['success']) {
                                $(this).parents("tr").remove();
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
                    // $.each(allVals, function(index, value) {
                    //     $('table tr').filter("[data-row-id='" + value + "']").remove();
                    // });
                }
            });

        });
    </script>
@endsection
