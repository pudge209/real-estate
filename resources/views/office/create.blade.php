<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Real Estate Office</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8fafc, #e0f7fa);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;


        }

        .form-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 60px auto;
            margin-top:100px;

        }

        .form-title {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            color: #2c3e50;

        }

        .form-label {
            font-weight: 500;
            color: #374151;
        }

        .form-control {
            border-radius: 10px;

        }

        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1e40af;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container">
            <div class="form-card">
                <div class="form-title">Add a New Real Estate Office</div>
                <form action="{{ route('office.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input id="country" type="text" name="country" class="form-control" value="{{ old('country') }}">
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input id="city" type="text" name="city" class="form-control" value="{{ old('city') }}">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street" class="form-label">Street</label>
                        <input id="street" type="text" name="street" class="form-control" value="{{ old('street') }}">
                        @error('street')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="office_name" class="form-label">Office Name</label>
                        <input id="office_name" type="text" name="office_name" class="form-control" value="{{ old('office_name') }}">
                        @error('office_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">Image</label>
                        <input id="image" type="file" name="image" class="form-control">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Office</button>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
