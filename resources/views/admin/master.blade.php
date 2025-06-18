@include('admin.header')

<body>
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
                @yield('content')
            </main>

            @include('admin.footer')
