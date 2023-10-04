@extends('layout.admin')

@section('title', 'Entitas')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Entitas</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table me-1"></i>
            Tabel
            <a href="{{ route('entity.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus me-2"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Entitas</th>
                        <th class="col-buttons"></th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($entities as $entity)
                    <tr>
                        <td>{{ "[{$entity->entitiy_code}] {$entity->name}" }}</td>
                        <td>
                            <a href="{{ route('entity.edit', $entity->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
