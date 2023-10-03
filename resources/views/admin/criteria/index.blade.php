@extends('layout.admin')

@section('title', 'Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Kriteria</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table me-1"></i>
            Tabel
            <a href="{{ route('criteria.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus me-2"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th class="col-buttons"></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($criterias as $criteria)
                    <tr>
                        <td>{{ $criteria->code }}</td>
                        <td>{{ $criteria->name }}</td>
                        <td>{{ $criteria->weight }}</td>
                        <td>
                            <a href="{{ route('criteria.edit', $criteria->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit fa-fw"></i></a>
                            <form action="{{ route('criteria.destroy', $criteria->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus data kriteria ini?')" title="Hapus"><i class="fa fa-trash fa-fw"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
