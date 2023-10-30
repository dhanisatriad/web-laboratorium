<div id="layoutSidenav">
    {{-- -----------------------------sidebar--------------------------------------------------------- --}}
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark shadow" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                    <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard">
                        Dashboard
                    </a>
                    <hr>
                    <a class="nav-link collapsed {{ $show === 'barang' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="false" aria-controls="collapseLaouts">
                        <div class="nav-link-icon me-2"><i class="fa-solid fa-box"></i></div>
                        Barang
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse {{ $show === 'barang' ? 'show' : '' }}" id="collapseOne"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu nav">
                            <a
                                class="nav-link {{ Request::is('dashboard/daftar-barang*') ? 'active' : '' }}"href="{{ route('daftar-barang.index') }}">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>
                                Daftar Barang
                            </a>

                            <a
                                class="nav-link {{ Request::is('dashboard/barang-rusak*') ? 'active' : '' }}"href="/dashboard/barang-rusak">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-regular fa-rectangle-xmark"></i>
                                </div>
                                Daftar Barang Rusak
                            </a>

                            <a
                                class="nav-link {{ Request::is('dashboard/daftar-dipinjam*') ? 'active' : '' }}"href="/dashboard/daftar-dipinjam">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                Daftar Barang Dipinjam
                            </a>
 
                            <a
                                class="nav-link {{ Request::is('dashboard/daftar-laboratorium*') ? 'active' : '' }}"href="/dashboard/daftar-laboratorium">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-door-open"></i>
                                </div>
                                Daftar Laboratorium
                            </a>

                            <a
                                class="nav-link {{ Request::is('dashboard/lokasi-penyimpanan*') ? 'active' : '' }}"href="/dashboard/lokasi-penyimpanan">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                Ruang Penyimpanan
                            </a>
                        </nav>
                    </div>

                    <hr>

                    <a class="nav-link collapsed {{ $show === 'client' ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon me-2"><i class="fa-solid fa-users-rectangle"></i></div>
                        Client
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ $show === 'client' ? 'show' : '' }}" id="collapseTwo"
                        aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu nav" id="sidenavAccordionPages">
                            <a
                                class="nav-link {{ Request::is('dashboard/daftar-client*') ? 'active' : '' }}"href="{{ route('daftar-client.index') }}">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-regular fa-address-book"></i>
                                </div>
                                Daftar Client
                            </a>

                            <a
                                class="nav-link {{ Request::is('dashboard/daftar-permohonan*') ? 'active' : '' }}"href="{{ route('permohonan') }}">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                Daftar Permohonan
                            </a>

                            <a
                                class="nav-link {{ Request::is('dashboard/check-konfirmasi*') ? 'active' : '' }}"href="{{ route('checkView') }}">
                                <div class="nav-link-icon me-1">
                                    <i class="rotate fa-solid fa-right-left"></i>
                                </div>
                                Check In & Check Out
                            </a>


                        </nav>
                    </div>

                    <hr>
                    <a class="nav-link collapsed {{ $show === 'user' ? 'active' : '' }}" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon me-2"><i class="fa-solid fa-user-large"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ $show === 'user' ? 'show' : '' }}" id="collapseThree" aria-labelledby="headingThree"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu nav" id="sidenavAccordionPages">
                            <a class="nav-link {{ Request::is('dashboard/daftar-user/') ? 'active' : '' }}"href="/dashboard/daftar-user/{{ auth()->user()->id }}">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-user-large"></i>
                                </div>
                                My Account
                            </a>
                            @if (auth()->user()->level == "Admin")
                            <a class="nav-link {{ Request::is('dashboard/daftar-user') ? 'active' : '' }}"href="/dashboard/daftar-user">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                Daftar User
                            </a>
                            <a class="nav-link"href="/dashboard/register">
                                <div class="nav-link-icon me-1">
                                    <i class="fa-solid fa-user-plus"></i>
                                </div>
                                Tambah User
                            </a>

                            @endif

                        </nav>
                    </div>
                    {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a> --}}
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ auth()->user()->name }}
            </div>
        </nav>
    </div>
