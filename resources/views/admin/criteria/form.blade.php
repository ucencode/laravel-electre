@extends('layout.admin')

@section('title', 'Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Kriteria</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table me-1"></i>
            @if($is_add)
                Tambah Kriteria Baru
            @else
                Ubah Kriteria
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($is_add)
                        <form action="{{ route('criteria.store') }}" method="POST">
                    @else
                        <form action="{{ route('criteria.update', $criteria->id) }}" method="POST">
                        @method('PUT')
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label @if($is_add) label-required @endif">Kode Kriteria</label>
                            @if ($is_add)
                            <input type="text" value="{{ old('code', $criteria->getGeneratedCode() ) }}" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Kode">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @else
                            <p>{{ $criteria->code }}</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label label-required">Nama Kriteria</label>
                            <input type="text" value="{{ old('name', $criteria->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Bobot</label>
                            <input type="number" value="{{ old('weight', $criteria->weight) ?? 0 }}" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" min="0" placeholder="Bobot">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <a href="{{ route('criteria.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left me-2"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
