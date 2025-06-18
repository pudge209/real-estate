@extends('admin.master')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary back-button mb-5">&leftarrow; Back</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Number</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->role }}</td>
                <td>{{ $admin->number }}</td>
                <td>
                    <a class="btn btn-outline-success" href="{{ route('admin.show', ['id' => $admin->id]) }}">
                        <i class="fas fa-eye"></i> Show
                    </a>
                    <a class="btn btn-outline-success" href="{{ route('admin.real', ['id' => $admin->id]) }}">
                        <i class="fas fa-eye"></i> Show Real
                    </a>
                    <a class="btn btn-outline-primary" href="{{ route('admin.edit', ['id' => $admin->id]) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form class="d-inline-block" action="{{ route('admin.delete', ['id' => $admin->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this admin?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
