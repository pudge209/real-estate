<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .content {
            padding-top: 60px; /* Adjust this value according to your navbar height */
        }
        .icon-lg {
            font-size: 3rem; /* Adjust the size as needed */
        }
        .icon-container {
            text-align: center; /* Center-align icons and content */
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .card {
            border-radius: 8px; /* Rounded corners for the cards */
        }
    </style>
</head>
<body>
    @include('admin.header')

    <div class="wrapper">
        @include('admin.sidebar')

        <div class="main">
            @include('admin.master-nav')

            <main class="content">
                @if (session()->has('success'))
                    <div class="alert alert-success w-50 mx-auto">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger w-50 mx-auto">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

                    <div class="row">
                        <!-- Total Created -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-file-alt icon-lg text-primary"></i>
                                    <div>
                                        <h5>Total Created</h5>
                                        <h2>{{ $totalCreated }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Published -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-check-circle icon-lg text-success"></i>
                                    <div>
                                        <h5>Total Published</h5>
                                        <h2>{{ $totalPublished }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Unpublished -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-exclamation-circle icon-lg text-warning"></i>
                                    <div>
                                        <h5>Total Unpublished</h5>
                                        <h2>{{ $totalNotPublished }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Offices -->
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-building icon-lg text-primary"></i>
                                    <div>
                                        <h5>Total Offices</h5>
                                        <h2>{{ $totalOffices }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Amount Collected -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-dollar-sign icon-lg text-success"></i>
                                    <div>
                                        <h5>Total Amount Collected</h5>
                                        <h2>{{ number_format($totalAmount, 2) }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Average Rating -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-star icon-lg text-warning"></i>
                                    <div>
                                        <h5>TOTLA Rating</h5>
                                        <h2>{{$averageRating}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Reviews -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body icon-container">
                                    <i class="fas fa-comments icon-lg text-info"></i>
                                    <div>
                                        <h5>Total Reviews</h5>
                                        <h2>{{ $totalReviews }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('admin.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
