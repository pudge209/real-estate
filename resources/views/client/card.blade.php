<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Cards</title>
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
        /* Custom styles for modal buttons */
        .modal-body .btn-custom {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .btn-request-estate {
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-request-estate:hover {
            background-color: #0056b3;
        }
        .btn-request-tour {
            background-color: #28a745;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-request-tour:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($real as $item)
                <div class="col">
                    <div class="card">
                        <a href="{{ route('real.show', ['real' => $item->id]) }}" class="card-link">
                            @if(!empty($item->image))
                                <img src='{{asset("storage/real-image/$item->image")}}' class="card-img-top img-fluid" alt="Real Estate Image">
                            @else
                                <img src='{{asset("storage/real-image/no-image.jpg")}}' class="card-img-top img-fluid" alt="No Image Available">
                            @endif
                        </a>
                        @if($item->user_id !== Auth::id())
                        <form action="{{ route('wishlist.add', $item->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm" title="Add to Wishlist">
                                <i class="fas fa-heart text-danger"></i>
                            </button>
                        </form>
                    @endif
                        <div class="card-body">
                            <p class="card-text">Real Type:
                                @if($item->real_type == 1)
                                    Residential
                                @elseif($item->real_type == 2)
                                    Commercial Land
                                @elseif($item->real_type == 3)
                                    Other
                                @endif
                            </p>
                            <p class="card-text">City: {{$item->city}}</p>
                            <p class="card-text">Price: {{$item->price}} SP</p>
                            <p class="card-text">Offer type: {{$item->status}}</p>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestModal{{ $item->id }}">
                                Request
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal for each estate item -->
                <div class="modal fade" id="requestModal{{ $item->id }}" tabindex="-1" aria-labelledby="requestModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="requestModalLabel{{ $item->id }}">Request Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- The forms here are adapted based on the `estateId` -->
                                <form action="{{ route('email', ['estateId' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-custom btn-request-estate w-100">Request to Buy Estate</button>
                                </form>
                                <form action="{{ route('request-virtual-tour', ['estateId' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-custom btn-request-tour w-100">Request Virtual Tour</button>
                                </form>
                                @if($item->user_id !== Auth::id())
                                    <a href="{{ route('conversations.create', ['user_id' => $item->user_id]) }}" class="btn btn-custom btn-request-tour w-100">
                                        Send Message
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
