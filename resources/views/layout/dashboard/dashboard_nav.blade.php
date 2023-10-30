<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark shadow bg-dark d-flex flex-nowrap">
        <!-- Navbar Brand-->
        <div class="order-0 me-3">
            <a class="navbar-brand ps-3" href="/">Laboratorium Teknik Elektro</a>
        </div>
        <!-- Sidebar Toggle-->
        <div>
            <button class="btn btn-link btn-sm order-2 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
        </div>
        <!-- Navbar Search-->
        {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form> --}}
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }} <i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end bg-dark drop-user" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item  text-white" href="/dashboard/daftar-user/{{ auth()->user()->id }}">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                class="text-decoration-none text-white">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>


