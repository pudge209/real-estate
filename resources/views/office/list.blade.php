<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Directory</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e6e9f0, #eef1f5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .search-bar {
            margin-top: 80px;
            margin-bottom: 40px;
            position: relative;
        }

        .search-bar input {
            padding-left: 40px;
            border-radius: 30px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            height: 50px;
        }

        .search-bar i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c63ff;
            font-size: 18px;
            text-decoration: none;
        }

        .office-card {
            display: flex;
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 220px;
        }

        .office-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.1);
        }

        .office-image-container {
            flex: 0 0 240px;
            max-width: 240px;
            overflow: hidden;
        }

        .office-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .office-body {
            flex: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .office-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }

        .office-info {
            font-size: 1rem;
            color: #555;
            margin-bottom: 6px;
        }

        .btn-custom {
            background-color: #6c63ff;
            color: white;
            border-radius: 25px;
            padding: 8px 18px;
            font-size: 0.95rem;
            align-self: flex-start;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #4b45c2;
            transform: translateY(-2px);
        }

        .no-results {
            text-align: center;
            color: #999;
            font-size: 1.2rem;
            margin-top: 60px;
        }

        @media (max-width: 768px) {
            .office-card {
                flex-direction: column;
            }

            .office-image-container {
                width: 100%;
                height: 200px;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <x-app-layout></x-app-layout>

    <div class="container">
        <!-- Search Bar -->
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" id="search" class="form-control" placeholder="Search by office name...">
        </div>

        <!-- Office Cards -->
        <div id="officeCards">
            @forelse ($offices as $office)
                <div class="mb-4 office-card-item">
                    <div class="office-card">
                        <div class="office-image-container">
                            <img src="{{ $office->image ? asset('storage/office-image/' . $office->image) : asset('storage/office-image/no-image.jpg') }}" class="office-image" alt="Office Image">
                        </div>
                        <div class="office-body">
                            <div class="office-title">{{ $office->office_name }}</div>
                            <div class="office-info"><strong>Country:</strong> {{ $office->country }}</div>
                            <div class="office-info"><strong>City:</strong> {{ $office->city }}</div>
                            <div class="office-info"><strong>Street:</strong> {{ $office->street }}</div>

                            <a class="btn-custom mt-3 " href="{{ route('office.show', ['office' => $office->id]) }}">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-results">No offices available.</div>
            @endforelse
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search');
            const cards = document.querySelectorAll('.office-card-item');

            searchInput.addEventListener('input', function () {
                const term = this.value.toLowerCase();
                let visibleCount = 0;

                cards.forEach(card => {
                    const title = card.querySelector('.office-title').textContent.toLowerCase();
                    const match = title.includes(term);
                    card.style.display = match ? 'block' : 'none';
                    if (match) visibleCount++;
                });

                document.querySelector('.no-results')?.classList.toggle('d-none', visibleCount > 0);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
