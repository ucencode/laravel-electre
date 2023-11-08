@extends('layout.admin')

@section('title', 'Alternatif')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Alternatif</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-hand-o-right me-1"></i>
            Alternatif merujuk pada pilihan atau opsi yang tersedia untuk dipertimbangkan dalam proses pengambilan keputusan.
            <a href="{{ route('alternative.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus me-2"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Alternatif</th>
                        <th class="col-buttons"></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($alternatives as $alternative)
                    <tr>
                        <td>{{ $alternative->code }}</td>
                        <td>{{ $alternative->name }}</td>
                        <td>
                            <a href="{{ route('alternative.edit', $alternative->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit fa-fw"></i></a>
                            <form action="{{ route('alternative.destroy', $alternative->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" title="Hapus"><i class="fa fa-trash fa-fw"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
