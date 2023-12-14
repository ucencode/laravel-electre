@extends('layout.auth')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center text-white font-weight-light my-3">Aplikasi Sistem Pendukung Keputusan Metode Electre</h3>
                </div>
                <div class="card-body">
                    @include('partials.flash')
                    <h6 class="text-center font-weight-light">Silahkan registrasi terlebih dahulu...</h6>
                    <form method="post" action="{{ route('register') }}">
                    @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('name') is-invalid @enderror" id="inputName" type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}"/>
                                    <label for="inputName">Nama</label>
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" />
                            <label for="inputEmail">Email</label>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password"
                                        name="password" placeholder="Password baru" @error('password') value="{{ old('password') }}" @enderror/>
                                    <label for="inputPassword">Kata Sandi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control @error('password') is-invalid @enderror" id="inputPasswordConfirm" type="password"
                                        name="password_confirmation" placeholder="Confirm password" />
                                    <label for="inputPasswordConfirm">Konfirmasi Kata Sandi</label>
                                </div>
                            </div>
                            @error('password')
                            <div class="col-md-12">
                                <small class="text-danger">{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid">
                                <button class="btn btn-red btn-block btn-lg" type="submit">Buat Akun Baru</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a class="text-danger" href="{{ route('login') }}">Sudah punya akun? Masuk disini</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
