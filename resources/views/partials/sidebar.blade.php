<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark bg-grey-200" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link text-white {{ Route::is('dashboard') ? 'active bg-grey-100' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-th-large fa-fw text-white"></i></div>
                    Dashboard
                </a>
                <a class="nav-link text-white {{ Route::is('tutorial') ? 'active bg-grey-100' : '' }}" href="{{ route('tutorial') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-file-text fa-fw text-white"></i></div>
                    Tutorial
                </a>
                <div class="sb-sidenav-menu-heading text-white">Menu</div>
                <a class="nav-link text-white {{ Route::is('alternative.*') ? 'active bg-grey-100' : '' }}" href="{{ route('alternative.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-random fa-fw text-white"></i></div>
                    Alternatif
                </a>
                <a class="nav-link text-white {{ Route::is('criteria.*') ? 'active bg-grey-100' : '' }}" href="{{ route('criteria.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-list-ul fa-fw text-white"></i></div>
                    Kriteria
                </a>
                <a class="nav-link text-white {{ Route::is('score.*') ? 'active bg-grey-100' : '' }}" href="{{ route('score.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-table fa-fw text-white"></i></div>
                    Nilai
                </a>
                <a class="nav-link text-white {{ Route::is('result.*') ? 'active bg-grey-100' : '' }}" href="{{ route('result.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-bar-chart fa-fw text-white"></i></div>
                    Hasil
                </a>
                @if(auth()->user()->hasRole('admin'))
                <a class="nav-link text-white {{ Route::is('user.*') ? 'active bg-grey-100' : '' }}" href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users fa-fw text-white"></i></div>
                    Pengguna
                </a>
                @endif
            </div>
        </div>
    </nav>
</div>
