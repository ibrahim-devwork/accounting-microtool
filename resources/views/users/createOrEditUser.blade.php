@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ $user ? route('users.update', $user->id) : route('users.store') }}">
                    @csrf
                    @if ($user)
                        @method('PUT')
                    @endif
                    <h2>{{ $user ? 'Edit User' : 'Create User' }}</h2>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"  id="name" name="name" value="{{ old('name', $user ? $user->name : '') }}">
                            @error('name')
                               <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email" name="email" value="{{ old('email', $user ? $user->email : '') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!$user)
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">{{ $user ? 'Update User' : 'Create User' }}</button>                
                </form>
            </div>
        </div>
    </div>
@endsection
