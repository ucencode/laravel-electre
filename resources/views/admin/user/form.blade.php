@extends('layout.admin')

@section('title', 'User')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">User</h1>
    @include('partials.flash')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table me-1"></i>
            @if($is_add)
                Add User
            @else
                Edit User
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($is_add)
                        <form action="{{ route('user.store') }}" method="POST">
                    @else
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @method('PUT')
                    @endif
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left me-2"></i> Back</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
