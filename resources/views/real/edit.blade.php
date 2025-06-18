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
        <form action="{{ route('real.update', ['real' => $real->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input id="country" type="text" name="country" class="form-control" value="{{ old('country', $real->country) }}">
                @error('country')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input id="city" type="text" name="city" class="form-control" value="{{ old('city', $real->city) }}">
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="street" class="form-label">Street</label>
                <input id="street" type="text" name="street" class="form-control" value="{{ old('street', $real->street) }}">
                @error('street')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input id="zip_code" type="text" name="zip_code" class="form-control" value="{{ old('zip_code', $real->zip_code) }}">
                @error('zip_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="statusSell" value="sell" {{ old('status', $real->status) == 'sell' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusSell">Sell</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="statusRent" value="rent" {{ old('status', $real->status) == 'rent' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusRent">Rent</label>
                </div>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input id="image" type="file" name="image" class="form-control">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="real_images" class="form-label">Additional Images</label>
                <input id="real_images" type="file" name="real_images[]" class="form-control" multiple>
                @error('real_images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input id="size" type="number" name="size" class="form-control" value="{{ old('size', $real->size) }}">
                @error('size')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input id="price" type="number" name="price" class="form-control" value="{{ old('price', $real->price) }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $real->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="real_type" class="form-label">Type</label>
                <select id="real_type" class="form-select" name="real_type" required>
                    <option value="">Select estate type</option>
                    <option value="1" @if(old('real_type', $real->real_type) == 1) selected @endif>Residential</option>
                    <option value="2" @if(old('real_type', $real->real_type) == 2) selected @endif>Commercial Land</option>
                    <option value="3" @if(old('real_type', $real->real_type) == 3) selected @endif>Other Type</option>
                </select>
            </div>
            <div id="residentialFields" class="mb-3" style="display: none;">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" name="rooms" class="form-control" value="{{ old('rooms', $real->house->rooms ?? '') }}">
                <label for="bedrooms" class="form-label">Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms', $real->house->bedrooms ?? '') }}">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $real->house->bathrooms ?? '') }}">
                <label for="garage" class="form-label">Garage</label>
                <input type="number" name="garage" class="form-control" value="{{ old('garage', $real->house->garage ?? '') }}">
            </div>
            <div id="commercialFields" class="mb-3" style="display: none;">
                <label for="commercial_kind" class="form-label">Commercial Kind</label>
                <input type="text" name="commercial_kind" class="form-control" value="{{ old('commercial_kind', $real->commercial->commercial_kind ?? '') }}">
                <label for="parking_spot" class="form-label">Parking Spot</label>
                <input type="number" name="parking_spot" class="form-control" value="{{ old('parking_spot', $real->commercial->parking_spot ?? '') }}">
            </div>
            <div id="otherTypeFields" class="mb-3" style="display: none;">
                <label for="type_of_use" class="form-label">Type of Use</label>
                <textarea name="type_of_use" id="type_of_use" class="form-control" rows="3">{{ old('type_of_use', $real->other->type_of_use ?? '') }}</textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Update Estate">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('real_type');
            const residentialFields = document.getElementById('residentialFields');
            const commercialFields = document.getElementById('commercialFields');
            const otherTypeFields = document.getElementById('otherTypeFields');

            function toggleFields() {
                residentialFields.style.display = 'none';
                commercialFields.style.display = 'none';
                otherTypeFields.style.display = 'none';

                if (typeSelect.value === '1') {
                    residentialFields.style.display = 'block';
                } else if (typeSelect.value === '2') {
                    commercialFields.style.display = 'block';
                } else if (typeSelect.value === '3') {
                    otherTypeFields.style.display = 'block';
                }
            }

            typeSelect.addEventListener('change', toggleFields);
            toggleFields(); // Initial call to set the correct fields on load
        });
    </script>
</body>
</html>
