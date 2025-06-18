<x-app-layout>
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .office-container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-top:100px;
        }

        .office-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .office-details {
            padding: 30px;
        }

        .office-details h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .office-details p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #333;
        }

        .office-details .btn-primary {
            margin-top: 20px;
            background-color: #ff5a5f;
            border: none;
        }

        .office-details .btn-primary:hover {
            background-color: #e04848;
        }

        @media (max-width: 768px) {
            .office-flex {
                flex-direction: column;
            }

            .office-image-wrapper {
                height: 250px;
            }
        }

        .office-image-wrapper {
            flex: 1;
            max-height: 400px;
            overflow: hidden;
        }

        .office-text-wrapper {
            flex: 1;
        }

        .office-flex {
            display: flex;
        }
    </style>
</head>
<body>

        <div class="container mt-5">
        <div class="office-container">
            <div class="office-flex ">
                <div class="office-image-wrapper">
                    @if(!empty($office->image))
                        <img src="{{ asset('storage/office-image/'.$office->image) }}" alt="Office Image" class="office-image">
                    @else
                        <img src="{{ asset('storage/office-image/no-image.jpg') }}" alt="No Image Available" class="office-image">
                    @endif
                </div>
                <div class="office-text-wrapper office-details">
                    <h2>{{ $office->office_name }}</h2>
                    <p><strong>Country:</strong> {{ $office->country }}</p>
                    <p><strong>City:</strong> {{ $office->city }}</p>
                    <p><strong>Street:</strong> {{ $office->street }}</p>
                    <a href="{{ route('office.mo', ['officeId' => $office->id]) }}" class="btn btn-primary">View Offers</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
