<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        .position-relative .fas {
            color: #6c757d; /* Icon color */
            margin-top: 10px;
        }
        .position-relative input {
            padding-left: 2.5rem; /* Add space for the icons */
            size: 25px
        }
    </style>
</head>
<body class="login-body">
@include("nav")

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text text-warning text-center mb-4">Login</div>

        <!-- Email Address -->
        <div class="email position-relative mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <i class="fas fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 position-relative">
            <x-input-label for="password" :value="__('Password')" />
            <i class="fas fa-lock position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-black-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Forgot Password and Login Button -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="link mt-3 text-center">No account? <a href='{{route('register')}}'>Create one!</a></div>

        <!-- Social Icons -->
        <div class="icon text-center mt-3">
            <span>
                <a href="#" target="_blank" class="ms-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="ms-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="ms-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="ms-2"><i class="fab fa-pinterest"></i></a>
                <a href="#" class="ms-2"><i class="fab fa-google"></i></a>
            </span>
        </div>
    </form>
</x-guest-layout>

</body>
</html>
