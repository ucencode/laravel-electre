@extends('layout.base')

@push('styles')
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet" />
@endpush

@section('body')

<body class="sb-nav-fixed">
    @include('partials.navbar')
    <div id="layoutSidenav">
        @include('partials.sidebar')
        <div id="layoutSidenav_content" class="bg-pink-100">
            <main>
                @yield('content')
            </main>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')

    <script>

    </script>

    @stack('scripts')
</body>
@endsection
