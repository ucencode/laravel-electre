@extends('layout.auth')

@section('title', 'Masuk')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-3">Aplikasi Sistem Pendukung Keputusan Metode Electre</h3>
                </div>
                <div class="card-body">
                    @include('partials.flash')
                    <h6 class="text-center font-weight-light">Silahkan login untuk masuk ke dalam aplikasi...</h6>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" placeholder="name@example.com" value="{{ old('email') }}" />
                            <label for="inputEmail">Email</label>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword" placeholder="Kata Sandi" />
                            <label for="inputPassword">Kata Sandi</label>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            {{-- <a class="small" href="#">Forgot Password?</a> --}}
                            <button class="btn btn-danger w-100 btn-lg" type="submit">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a class="text-danger" href="{{ route('register') }}">Belum punya akun? Buat baru disini</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
