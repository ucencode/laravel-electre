@extends('layout.admin')

@section('title', 'User')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">User</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table me-1"></i>
            User List
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-end"><i class="fa fa-plus me-2"></i> Add</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit me-2"></i> Edit</a>
                            {{-- Delete user button is disabled if the user is currently logged in --}}
                            @if ($user->id == Auth::user()->id)
                                <span class="btn btn-danger btn-sm disabled"><i class="fa fa-trash me-2"></i> Delete</span>
                            @else
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash me-2"></i> Delete</button>
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
