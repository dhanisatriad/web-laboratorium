<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Laboratorium - Dashboard</title>

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    {{-- bootstrap --}}




    {{-- siple database --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}
    <link href="/css/styles.css" rel="stylesheet" />
    {{-- siple database --}}

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js" integrity="sha512-qOBWNAMfkz+vXXgbh0Wz7qYSLZp6c14R0bZeVX2TdQxWpuKr6yHjBIM69fcF8Ve4GUX6B6AKRQJqiiAmwvmUmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- jquery --}}

    {{-- live-search --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- live-search --}}


    {{-- font --}}
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    {{-- font --}}

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- trix editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    <style>
        #pilih_barang .dropdown-menu {
            border-color: black;
            background-color: #ababab;
        }

        .datepicker td,
        th {
            text-align: center;
            padding: 8px 12px;
            font-size: 14px;
        }

        @media print {
            .cetak {
                page-break-inside: avoid !important;
            }

            body * {
                visibility: hidden;
                /* display: none; */
            }

            #cetak {
                position: absolute;
                left: 0;
                top: 0;
            }

            .cetak,
            .cetak * {
                visibility: visible;
                /* display: inline-block; */
            }

        }

        .cetak * {
            font-family: "Courier New", monospace;
            font-size: 8pt;
        }

        .fit-image {
            width: 100%;
            object-fit: cover;
            height: 200px;
        }

        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    {{-- trix editor --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Laboratorium</title>
</head>

<body  style="background-color: #d3eaf2">

    <div class="container-fluid p-0 m-0">
        <div>
            <div >
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
                    <div class="order-0">
                        <a class="navbar-brand ps-3" href="/">Laboratorium Teknik Elektro</a>
                    </div>

                    <button class="navbar-toggler btn-m me-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse ms-3 ms-lg-0 " id="navbarNav">

                        <div class="dropdown ms-sm-0 mb-1 mb-lg-0">
                            <a class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @if (request('laboratorium'))
                                    @foreach ($labs as $lab)
                                        <?php $a = request('laboratorium'); ?>
                                        @if ($lab->slug == $a)
                                            {{ $lab->nama_laboratorium }}
                                        @endif
                                    @endforeach
                                @else
                                    Laboratorium
                                @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="/pinjambarang">ALL</a>
                                </li>
                                @foreach ($labs as $lab)
                                    <li><a class="dropdown-item"
                                            href="/pinjambarang/?laboratorium={{ $lab->slug }}">{{ $lab->nama_laboratorium }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="dropdown ms-sm-1 mb-1 mb-lg-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cek">
                                Cek Peminjaman
                            </button>
                        </div>

                        <ul class="navbar-nav ms-auto me-3 me-lg-4">
                            <li class="nav-item">
                                <form action="{{ route('pinjamBarang') }}">
                                    @if (request('laboratorium'))
                                        <input type="hidden" name="laboratorium" value="{{ request('laboratorium') }}">
                                    @endif
                                    <div class="input-group ">
                                        <input type="text" class="form-control " placeholder="search" name="search"
                                            value={{ request('search') }}>
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </form>
                            </li>

                            @auth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle ps-3" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user fa-fw"></i>{{ auth()->user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="/dashboard">
                                                <i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a>
                                        </li>
                                        <hr class="dropdown-divider">
                                        <li>
                                            <form action="/logout" method="post">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-box-arrow-right"></i> Logout</button>

                                            </form>
                                        </li>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}"
                                        class="nav-link {{ $active === 'LOGIN' ? 'active' : '' }}"><i
                                            class="bi bi-box-arrow-in-right"></i> Login</a>
                                </li>

                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container-fluid text-dark px-5">
                <div class="container">
                    <h1 class="text-dark fs-3 m-auto fw-bold">@yield('page')</h1>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    </div>











</body>

</html>
