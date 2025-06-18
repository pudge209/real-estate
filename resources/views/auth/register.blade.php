


@include('nav')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body class="login-body">


<x-guest-layout>


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text text-warning">register</div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('role')" />
            <select id="role" class="block mt-1 w-full" name="role" required>
                <option value="">Select user type</option>
                <option value="1" @if(old('role') == 1) selected @endif>Admin</option>
                <option value="2" @if(old('role') == 2) selected @endif>Client</option>
                <option value="3" @if(old('role') == 3) selected @endif>Owner</option>
                <option value="4" @if(old('role') == 4) selected @endif>Vendor</option>
            </select>


            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <!-- Name -->

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- date Address -->

        <div class="mt-4">
            <x-input-label for="date" :value="__('date')" />
            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')"
                aria-placeholder="DD/MM/YYYY" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="number" :value="__('number')" />
            <x-text-input id="number" class="block mt-1 w-full" type="tel" name="number" :value="old('number')" />
            <x-input-error :messages="$errors->get('number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
</body>
