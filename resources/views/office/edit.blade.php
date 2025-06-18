<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Real Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<x-app-layout>
</x-app-layout>

<body>
    <h1>Welcome</h1>
    <div class="container mt-5">
        <form action="{{ route('office.update', ['office' => $office->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input id="country" type="text" name="country" class="form-control" value="{{ old('country', $office->country) }}">
                @error('country')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input id="city" type="text" name="city" class="form-control" value="{{ old('city', $office->city) }}">
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="street" class="form-label">Street</label>
                <input id="street" type="text" name="street" class="form-control" value="{{ old('street', $office->street) }}">
                @error('street')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="office_name" class="form-label">Zip Code</label>
                <input id="office_name" type="text" name="office_name" class="form-control" value="{{ old('office_name', $office->office_name) }}">
                @error('office_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input id="image" type="file" name="image" class="form-control">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            <input type="submit" class="btn btn-primary" value="Update Estate">
        </form>
    </div>

