<nav class="sb-topnav navbar navbar-expand navbar-dark bg-pink-200">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-darkbrown" href="#">SPK Electre</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fa fa-bars text-brown"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-darkbrown" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-user-circle-o fa-fw me-2"></i>{{ Auth::user()->name ?? "(name)" }}</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                {{-- <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider" /></li> --}}
                <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="return confirm('Apakah anda yakin akan keluar?')">Keluar</a></li>
            </ul>
        </li>
    </ul>
</nav>
