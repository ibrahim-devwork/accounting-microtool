@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row mb-4">
                <div class="col">
                    <h1>Dashboard</h1>
                </div>
                <div class="col text-end">
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-success mt-2">
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mt-2">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row mt-2">
                <div class="col-md-6 offset-md-3">
                    <form method="POST" action="{{ route('home.search') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Search items"  value="{{ $search ?? '' }}">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table  table-striped mt-2">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date started process</th>
                        <th scope="col">Date finish process</th>
                        @if(auth()->user()->role === 'Admin')
                            <th scope="col">User</th>
                        @endif
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($processList as $process)
                        <tr>
                            <td>{{ $process->id }}</td>
                            <td>{{ $process->name }}</td>
                            <td>{{ $process->start_process_date ? $process->start_process_date : "-"}}</td>
                            <td>
                                {{ $process->updated_at }}
                            </td>
                            @if(auth()->user()->role === 'Admin')
                                <td>{{ $process->user->name }}</td>
                            @endif
                            <td>
                                {{-- <form action="{{ route('process-list.destroy', $process->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Are you sure you want to delete this process?')">Download</button>
                                </form> --}}
                                <a href="{{ route('download', $process->csv_file_name ?? 'file') }}" class="btn btn-primary">Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $processList->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
