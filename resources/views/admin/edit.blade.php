@extends('admin.master')
@section('content')
    <h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">&leftarrow;</a>
        Edit Admin
    </h1>
    <form action="{{ route('admin.update', ['id' => $admin->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Number</label>
            <input id="number" type="text" name="number" class="form-control" value="{{ old('number', $admin->number) }}">
            @error('number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input id="role" type="number" name="role" class="form-control" value="{{ old('role', $admin->role) }}">
            @error('role')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <input type="submit" class="btn btn-secondary" value="Save Admin">
        <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Back</a>
    </form>
@endsection
