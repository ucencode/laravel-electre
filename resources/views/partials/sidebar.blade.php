<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark bg-pink-200" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link text-brown {{ Route::is('dashboard') ? 'active bg-pink-200' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-th-large fa-fw text-brown"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading text-brown">Menu</div>
                <a class="nav-link text-brown {{ Route::is('alternative.*') ? 'active bg-pink-200' : '' }}" href="{{ route('alternative.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-random fa-fw text-brown"></i></div>
                    Alternatif
                </a>
                <a class="nav-link text-brown {{ Route::is('criteria.*') ? 'active bg-pink-200' : '' }}" href="{{ route('criteria.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul fa-fw text-brown"></i></div>
                    Kriteria
                </a>
                <a class="nav-link text-brown {{ Route::is('score.*') ? 'active bg-pink-200' : '' }}" href="{{ route('score.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-table fa-fw text-brown"></i></div>
                    Nilai
                </a>
                <a class="nav-link text-brown {{ Route::is('result.*') ? 'active bg-pink-200' : '' }}" href="{{ route('result.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-bar-chart fa-fw text-brown"></i></div>
                    Hasil
                </a>
                @if(auth()->user()->hasRole('admin'))
                <a class="nav-link text-brown {{ Route::is('user.*') ? 'active bg-pink-200' : '' }}" href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users fa-fw text-brown"></i></div>
                    Pengguna
                </a>
                @endif
            </div>
        </div>
    </nav>
</div>
