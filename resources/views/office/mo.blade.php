<x-app-layout>
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matched Real Estate Offers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card-img-top {
            border-radius: 16px 16px 0 0;
            object-fit: cover;
            height: 200px;
        }
        .card-body {
            padding: 1.25rem;
            color: #343a40;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .card-text {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Matched Real Estate Offers</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($reals as $real)
                <div class="col">
                    <a href="{{ route('real.show', ['real' => $real->id]) }}" class="card-link">
                        <div class="card">
                            @if(!empty($real->image))
                                <img src="{{ asset('storage/real-image/' . $real->image) }}" class="card-img-top img-fluid" alt="Real Estate Image">
                            @else
                                <img src="{{ asset('storage/real-image/no-image.jpg') }}" class="card-img-top img-fluid" alt="No Image Available">
                            @endif
                            <div class="card-body">
                                <p class="card-title">
                                    Real Type:
                                    @if($real->real_type == 1)
                                        Residential
                                    @elseif($real->real_type == 2)
                                        Commercial Land
                                    @elseif($real->real_type == 3)
                                        Other
                                    @endif
                                </p>
                                <p class="card-text">City: {{ $real->city }}</p>
                                <p class="card-text">Price: {{ number_format($real->price) }} SP</p>
                                <p class="card-text">Offer Type: {{ $real->status }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
