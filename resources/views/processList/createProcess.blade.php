@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('process-list.store') }}" enctype="multipart/form-data">
                    @csrf
                    <h2>Create new process</h2>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"  id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                               <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    @if(auth()->user()->role === 'Admin')
                        <div class="mb-3">
                            <label for="dropdown">Select a user :</label>
                            <select class="form-control  @error('user_id') is-invalid @enderror" name="user_id" id="dropdown"  value="{{ old('user_id') }}">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                               <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="ofx_file" class="form-label">Select an OFX file :</label>
                        <input type="file" class="form-control @error('ofx_file') is-invalid @enderror"  id="ofx_file" name="ofx_file" value="{{ old('ofx_file') }}" accept=".ofx">
                        @error('ofx_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary"> Create process </button>                
                </form>
            </div>
        </div>
    </div>
@endsection
