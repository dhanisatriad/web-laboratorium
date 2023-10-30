@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                @if ($errors->any())
                    {!! implode(
                        '',
                        $errors->all(' <div class="alert alert-danger alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>'),
                    ) !!}
                @endif
                <div class="card my-4 shadow">
                    <div class="card-header text-white bg-primary fs-4 d-print-none">
                        <i class="fas fa-table me-1"></i>
                        Print kode barang Barang
                    </div>

                    <div class="card-body">
                        <a type="button" id="kembali" class="btn btn-primary d-print-none" href={{ url()->previous() }}>Kembali</a><br>
                        <div id="cetak">
                            @foreach ($barangs as $barang)
                                <div class="cetak card my-1 border border-dark d-inline-flex" style="width: 8cm;">
                                    <div class="row g-0">
                                        <div class="col-4 p-1">
                                            {{ QrCode::size(100)->generate($barang->kode_barang) }}
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body d-flex align-items-start flex-column text-break">
                                                <h6 class="card-title ">
                                                    Nama:{{ Str::length($barang->nama_barang) > 30 ? substr($barang->nama_barang, 0, 30) . '...' : $barang->nama_barang }}
                                                </h6>
                                                <h6 class="card-text">Kode:{{ $barang->kode_barang }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
@endsection

<script>
    window.onload = function() {
        window.print();
    }
</script>

{{-- <!DOCTYPE html>
<html>

<head>
    <title>Print Kode Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <style>
        @media print {
            div {
                break-inside: avoid;
            }
        }

        body {
            font-family: "Courier New", monospace;
            font-size: 8pt;
        }
    </style>
</head>

<body onload="window.print()">
    @foreach ($barangs as $barang)
        <div class="card m-1 border border-dark d-inline-flex" style="width: 8cm;">
            <div class="row g-0">
                <div class="col-4 p-1">
                    {{ QrCode::size(100)->generate($barang->kode_barang) }}
                </div>
                <div class="col-8">
                    <div class="card-body d-flex align-items-start flex-column">
                        <h6 class="card-title">
                            Nama:{{ Str::length($barang->nama_barang) > 30 ? substr($barang->nama_barang, 0, 30) . '...' : $barang->nama_barang }}
                        </h6>
                        <h6 class="card-text">Kode:{{ $barang->kode_barang }}</h6>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html> --}}
