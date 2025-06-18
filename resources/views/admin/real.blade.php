@extends('admin.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary back-button mb-5">&leftarrow; Back</a>

    <h1>Real Estate Information</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Country</th>
                <th>City</th>
                <th>Street</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($realEstates as $real)
                <tr>
                    <td>{{ $real->id }}</td>
                    <td>{{ $real->country }}</td>
                    <td>{{ $real->city }}</td>
                    <td>{{ $real->street }}</td>
                    <td>
                        @empty($real->image)
                            <img src="{{ asset('storage/real-image/no-image.jpg') }}" alt="No Image" width="100">
                        @else
                            <img src="{{ asset('storage/real-image/' . $real->image) }}" alt="Real Estate Image" width="100">
                        @endempty
                    </td>
                    <td class="col-3">
                        <a class="btn btn-outline-success" href="{{ route('admin.realShow', ['real' => $real->id]) }}">
                            <i class="fas fa-eye"></i> Show
                        </a>
                        {{-- Uncomment the following lines if editing and publishing/unpublishing functionality is needed --}}
                        {{-- <a class="btn btn-outline-primary" href="{{ route('real.edit', ['real' => $real->id]) }}">
                            <i class="fas fa-edit"></i> Edit
                        </a> --}}

                        <a class="btn btn-outline-{{ $real->pay == 1 ? 'danger' : 'dark' }}" href="#" onclick="event.preventDefault(); document.getElementById('handle-pay-form-{{ $real->id }}').submit();">
                            <i class="fas fa-upload"></i> {{ $real->pay == 1 ? 'Unpublish' : 'Publish' }}
                        </a>

                        <form id="handle-pay-form-{{ $real->id }}" action="{{ route('admin.handlePay', ['real' => $real->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="pay" value="{{ $real->pay == 1 ? 0 : 1 }}">
                        </form>

                        <form class="d-inline-block" action="{{ route('real.destroy', ['real' => $real->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this real estate?')">Delete <i class="fas fa-trash"></i></button>
                        </form>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
