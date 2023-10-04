<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-tachometer fa-fw"></i></div>
                    Dasbor
                </a>
                {{-- nilai --}}
                <a class="nav-link {{ Route::is('score.*') ? 'active' : '' }}" href="{{ route('score.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-list-ol fa-fw"></i></div>
                    Nilai
                </a>
                <div class="sb-sidenav-menu-heading">Modules</div>
                <a class="nav-link {{ Route::is('alternative.*') ? 'active' : '' }}" href="{{ route('alternative.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-cubes fa-fw"></i></div>
                    Alternatif
                </a>
                <a class="nav-link {{ Route::is('criteria.*') ? 'active' : '' }}" href="{{ route('criteria.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-list fa-fw"></i></div>
                    Kriteria
                </a>
                <a class="nav-link {{ Route::is('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users fa-fw"></i></div>
                    Pengguna
                </a>
            </div>
        </div>
    </nav>
</div>
