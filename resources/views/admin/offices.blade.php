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
                    <h1 class="h3 mb-3"><strong>Offices</strong></h1>

                    <div class="row">
                        <!-- Total Offices -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="align-middle text-primary me-2" data-feather="building"></i>
                                        <div>
                                            <h5>Total Offices</h5>
                                            <h2>{{ $totalOffices }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Offices and House Counts -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Offices and Their House Counts</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Office Name</th>
                                                <th>Number of Houses</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($officesWithHouseCount as $office)
                                                <tr>
                                                    <td>{{ $office->office_name }}</td>
                                                    <td>{{ $office->house_count }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.offices.viewHouses', $office->id) }}" class="btn btn-info btn-sm">View Houses</a>
                                                        <form action="{{ route('admin.offices.destroy', $office->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
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
