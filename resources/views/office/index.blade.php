<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;

        }

        .content {
            padding: 60px 20px 40px;
        }

        .office-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            background-color: #fff;

        }

        .office-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .office-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .office-info {
            padding: 20px;
        }

        .office-info h5 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .office-info p {
            margin: 0;
            color: #555;
            font-size: 0.95rem;
        }

        .office-actions {
            margin-top: 15px;
        }

        .office-actions .btn {
            margin-right: 8px;
        }

        .create-btn {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <x-app-layout></x-app-layout>

    <div class="container content mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-4">Your Offices</h2>
            <a href="{{ route('office.create') }}" class="btn btn-primary create-btn">+ Create an Office</a>
        </div>

        <div class="row">
            @foreach ($offices as $office)
                <div class="col-md-4 mb-4">
                    <div class="office-card">
                        @empty($office->image)
                            <img src="{{ asset('storage/office-image/no-image.jpg') }}" alt="No Image" class="office-image">
                        @else
                            <img src="{{ asset('storage/office-image/' . $office->image) }}" alt="Office Image" class="office-image">
                        @endempty

                        <div class="office-info">
                            <h5>{{ $office->office_name }}</h5>
                            <p><strong>Country:</strong> {{ $office->country }}</p>
                            <p><strong>City:</strong> {{ $office->city }}</p>
                            <p><strong>Street:</strong> {{ $office->street }}</p>

                            <div class="office-actions">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('office.show', ['office' => $office->id]) }}">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('office.edit', ['office' => $office->id]) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form class="d-inline" action="{{ route('office.destroy', ['office' => $office->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
