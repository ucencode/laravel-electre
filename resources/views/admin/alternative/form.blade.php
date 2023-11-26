@extends('layout.admin')

@section('title', 'Alternatif')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Alternatif</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header text-white">
            <i class="fa fa-edit me-1"></i>
            @if($is_add)
                Tambah Alternatif Baru
            @else
                Ubah Alternatif - {{ $alternative->code }}
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($is_add)
                        <form action="{{ route('alternative.store') }}" method="POST">
                    @else
                        <form action="{{ route('alternative.update', $alternative->id) }}" method="POST">
                        @method('PUT')
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label @if($is_add) label-required @endif">Kode Alternatif</label>
                            @if ($is_add)
                            <input type="text" value="{{ old('code', $alternative->getGeneratedCode() ) }}" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Kode">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @else
                            <p>{{ $alternative->code }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label label-required">Nama Alternatif</label>
                            <input type="text" value="{{ old('name', $alternative->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('alternative.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left me-2"></i> Kembali</a>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-save me-2"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
