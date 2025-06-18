<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<style>
            .fas {
            color: #007bff;
        }
</style>
    @php
    $roleType = Auth::check() ? Auth::user()->role : null;
$redirectUrl = null;
    if ($roleType !== null) {
        switch ($roleType) {
            case '1':
                $redirectUrl = 'admin.dashboard';
                break;
            case '2':
                $redirectUrl = 'client.dashboard';
                break;
            case '3':
                $redirectUrl = 'dashboard';
                break;
            default:
                $redirectUrl = 'vendor.dashboard';
                break;
        }
    }
    @endphp

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="container">
            @if ($redirectUrl === null)
                <a class="navbar-brand" href="{{ url('/') }}"><span class="text-warning">Syrian</span>Estate</a>
            @else
                <a class="navbar-brand" href="{{ route($redirectUrl) }}"><span class="text-warning">Syrian</span>Estate</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">{{ __('custom.home') }}</a>
                    </li>
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

                <!-- Language Icon -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <i class="fas fa-globe fa-2x language-icon" data-bs-toggle="modal" data-bs-target="#languageModal" style="cursor: pointer;"></i>
                </div>

                @if(Auth::check())
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <i class="fas fa-user"></i>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="dorp-down">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('conversations.index') " class="dorp-down">
                                {{ __('conversations') }}
                            </x-dropdown-link>

                            @if($roleType != 2)
                            <!-- Add Published link here -->
                            {{-- <x-dropdown-link :href="route('published')" class="dorp-down">
                                {{ __('Published') }}
                            </x-dropdown-link> --}}

                            <x-dropdown-link :href="route('real.index')" class="dorp-down">
                                {{ __('Create estate') }}
                            </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('wishlist.index')" class="dorp-down">
                                {{ __('Wishlist') }}
                            </x-dropdown-link>
                            @if($roleType != 2 && $roleType != 3)
                            <x-dropdown-link :href="route('office.index')" class="dorp-down">
                                {{ __('register-office') }}
                            </x-dropdown-link>
                        @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="dorp-down"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @if(Auth::check())
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">

                    </div>
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                            @if($roleType != 2)
                            <!-- Add Published link here -->
                            <x-responsive-nav-link :href="route('published')">
                                {{ __('Published') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('real.index')">
                                {{ __('Create estate') }}
                            </x-responsive-nav-link>
                            @endif
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
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

</body>
</html>
