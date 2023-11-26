@extends('layout.admin')

@section('title', 'Pengguna')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pengguna</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header text-white">
            Berikut adalah daftar pengguna yang terdaftar dalam sistem:
            <a href="{{ route('user.create') }}" class="btn btn-grey btn-sm float-end"><i class="fa fa-plus me-2"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }} @if($user->isCurrentlyLoggedIn()) <span class="badge text-white btn-pastel-red">You</span> @endif</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-yellow btn-sm" title="test"><i class="fa fa-edit me-2"></i> Ubah</a>
                            {{-- Delete user button is disabled if the user is currently logged in --}}
                            @if ($user->id == Auth::user()->id)
                                <span class="btn btn-pastel-red btn-sm disabled" onclick="alert('Tidak bisa menghapus user yg dipakai untuk saat ini')"><i class="fa fa-trash me-2"></i> Hapus</span>
                            @else
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-pastel-red btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')"><i class="fa fa-trash me-2"></i> Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
