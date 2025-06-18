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

                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Houses in {{ $office->office_name }}</strong></h1>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Houses</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>Street</th>
                                                <th>Zip Code</th>
                                                <th>Price</th>
                                                <th>Size</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($houses as $house)
                                                <tr>
                                                    <td>{{ $house->id }}</td>
                                                    <td>{{ $house->country }}</td>
                                                    <td>{{ $house->city }}</td>
                                                    <td>{{ $house->street }}</td>
                                                    <td>{{ $house->zip_code }}</td>
                                                    <td>{{ $house->price }}</td>
                                                    <td>{{ $house->size }}</td>
                                                    <td>{{ $house->status }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

            @include('admin.footer')
        </div>
    </div>
</body>
