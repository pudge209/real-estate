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
        .search-input {
            margin-bottom: 20px;
        }
        .price-input {
            width: 100%;
        }
        .radio-group {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .radio-group label {
            margin-right: 10px;
            cursor: pointer;
        }
        .radio-group input[type="radio"] {
            display: none;
        }
        .radio-group label span {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 50px;
            background-color: #ddd;
            transition: background-color 0.3s, color 0.3s;
        }
        .radio-group input[type="radio"]:checked + label span {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <x-app-layout>

    </x-app-layout>
    <div class="container mt-5">
        <!-- Price filter input -->
        <div class="row">
            <div class="col mt-5">
                <label for="priceInput" class="form-label">Maximum Price: <span id="priceOutput">9000000000</span> SP</label>
                <input type="range" class="form-range price-input" id="priceInput" min="0" max="9000000000" step="100000" value="9000000000">
            </div>
        </div>

        <!-- Offer type filter input -->
        <div class="row mt-3">
            <div class="col">
                <div class="radio-group">
                    <input type="radio" id="offerTypeAll" name="offerType" value="all" checked>
                    <label for="offerTypeAll"><span>All</span></label>

                    <input type="radio" id="offerTypeSale" name="offerType" value="sale">
                    <label for="offerTypeSale"><span>Sale</span></label>

                    <input type="radio" id="offerTypeRent" name="offerType" value="rent">
                    <label for="offerTypeRent"><span>Rent</span></label>
                </div>
            </div>
        </div>

        <!-- Real type filter input -->
        <div class="row mt-3">
            <div class="col">
                <label for="realTypeInput" class="form-label">Real Type:</label>
                <select id="realTypeInput" class="form-select">
                    <option value="all">All</option>
                    <option value="residential">Residential</option>
                    <option value="commercial land">Commercial Land</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>

        <!-- Real estate cards -->
        <div class="row row-cols-1 row-cols-md-4 g-4 mt-3" id="realEstateCards">
            @foreach($reals as $item)
                <div class="col">
                    <a href="{{ route('real.show', ['real' => $item->id]) }}" class="card-link">
                        <div class="card h-100">
                            @if(!empty($item->image))
                                <img src='{{asset("storage/real-image/$item->image")}}' class="card-img-top img-fluid" alt="Real Estate Image">
                            @else
                                <img src='{{asset("storage/real-image/no-image.jpg")}}' class="card-img-top img-fluid" alt="No Image Available">
                            @endif
                            <div class="card-body">
                                <p class="card-text real-type">
                                    @if($item->real_type == 1)
                                        Residential
                                    @elseif($item->real_type == 2)
                                        Commercial Land
                                    @elseif($item->real_type == 3)
                                        Other
                                    @endif
                                </p>
                                <p class="card-text">City: {{$item->city}}</p>
                                <p class="card-text price">{{$item->price}} SP</p>
                                <p class="card-text offer-type">{{$item->status}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceInput = document.getElementById('priceInput');
            const priceOutput = document.getElementById('priceOutput');
            const offerTypeInputs = document.getElementsByName('offerType');
            const realTypeInput = document.getElementById('realTypeInput');
            const realEstateCards = document.getElementById('realEstateCards').children;

            priceInput.addEventListener('input', filterCards);
            offerTypeInputs.forEach(input => input.addEventListener('change', filterCards));
            realTypeInput.addEventListener('change', filterCards);

            // Initial filter on page load
            filterCards();

            function filterCards() {
                const priceValue = parseFloat(priceInput.value);
                const offerTypeValue = document.querySelector('input[name="offerType"]:checked').value;
                const realTypeValue = realTypeInput.value;

                priceOutput.textContent = priceValue;

                Array.from(realEstateCards).forEach(card => {
                    const price = parseFloat(card.querySelector('.price').textContent.replace(/\D/g, ''));
                    const offerType = card.querySelector('.offer-type').textContent.trim().toLowerCase();
                    const realType = card.querySelector('.real-type').textContent.trim().toLowerCase();

                    if (
                        price <= priceValue &&
                        (offerTypeValue === 'all' || offerType === offerTypeValue) &&
                        (realTypeValue === 'all' || realType === realTypeValue)
                    ) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
