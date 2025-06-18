<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Syrian Estate</title>
    <style>
        .form-group {
            margin: 0;
        }

        .navbar-nav {
            flex-direction: row;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .form-inline {
            display: flex;
            align-items: center;
        }

        .language-icon {
            font-size: 1.5em;
            padding: 5px;
            margin-right: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/"><span class="text-warning">Syrian</span>Estate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="home">{{ __('custom.home') }}</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('help') }}">{{ __('custom.Help') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('services')}}">{{ __('custom.Services') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact.form')}}">{{ __('custom.Contact') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('office.list')}}" >{{ __('custom.office') }}</a>
                    </li>

                </ul>

                <div class="form-inline d-flex align-items-center">
                    <i class="fas fa-globe language-icon" data-bs-toggle="modal" data-bs-target="#languageModal"></i>
                </div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary me-2"><i class="fas fa-user"></i> Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary me-2"><i class="fas fa-user"></i> {{ __('custom.login') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('custom.register') }}</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Language Modal -->
    <div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languageModalLabel">Select Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lang') }}" method="get" id="languageForm">
                        @csrf
                        <div class="form-group mb-3">
                            <select name="lang" id="language-select" class="form-select">
                                <option value="ar" @selected(app()->getLocale() == 'ar')>Arabic</option>
                                <option value="en" @selected(app()->getLocale() == 'en')>English</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('languageForm').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

@yield('nav')

</html>
