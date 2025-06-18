@extends('admin.master')
@section('content')
    <h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">&leftarrow;</a>
        Category details
    </h1>
    <img src="{{asset('images/download.png')}}" alt="">
    <h4>ID:{{ $admin->id}}</h4>
    <p>Name: {{ $admin->name }}</p>
    <p>number: {{ $admin->number }}</p>
    <p>email: {{ $admin->email}}</p>
    <p>password: {{ $admin->password }}</p>
    <p>role: {{ $admin->role }}</p>
    {{-- <p>count: {{ $category->books->count() }}</p> --}}
    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">back</a>
@endsection
