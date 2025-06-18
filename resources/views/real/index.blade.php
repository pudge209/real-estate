<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <title>Document</title>
    <style>
        .content {
            padding-top: 60px; /* Adjust this value according to your navbar height */
        }
    </style>
</head>
<body>


    <x-app-layout></x-app-layout>

    <div class="content">
        <a href="{{ route('real.create') }}" class="btn btn-primary mt-3">Create an Estate</a>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>Zip Code</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($real as $real)
                    <tr>
                        <td>{{ $real->country }}</td>
                        <td>{{ $real->city }}</td>
                        <td>{{ $real->street }}</td>
                        <td>{{ $real->zip_code }}</td>
                        <td>{{ $real->size }}</td>
                        <td>{{ $real->status }}</td>
                        <td>{{ $real->price }}</td>
                        <td>
                            @empty($real->image)
                                <img src="{{ asset('storage/real-image/no-image.jpg') }}" alt="" width="100">
                            @else
                                <img src="{{ asset('storage/real-image/' . $real->image) }}" alt="" width="100">
                            @endempty
                        </td>
                        <td class="col-3">
                            <a class="btn btn-outline-success" href="{{ route('real.show', ['real' => $real->id]) }}">
                                <i class="fas fa-eye"></i> Show
                            </a>
                            <a class="btn btn-outline-primary" href="{{ route('real.edit', ['real' => $real->id]) }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Button to trigger the modal -->
                            <a class="btn btn-outline-{{ $real->pay == 1 ? 'danger' : 'dark' }}" href="#" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $real->id }}">
                                <i class="fas fa-upload"></i> {{ $real->pay == 1 ? 'Unpublish' : 'Publish' }}
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmModal-{{ $real->id }}" tabindex="-1" aria-labelledby="confirmModalLabel-{{ $real->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel-{{ $real->id }}">Confirm {{ $real->pay == 1 ? 'Unpublish' : 'Publish' }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($real->pay == 1)
                                                <div class="unpublish-section">
                                                    <p>Are you sure you want to unpublish this real estate listing?</p>
                                                </div>
                                            @else
                                                <div class="publish-section">
                                                    <p>Your fee to add your real estate is: SP {{ number_format($real->price * 0.01 / 100, 2) }}</p>
                                                    <div id="qrCode-{{ $real->id }}" class="text-center mb-3">
                                                        <p>Scan the QR code below to proceed with the payment:</p>
                                                        <img src="{{ asset('images/Example-QR-code.webp') }}" alt="QR Code" class="img-fluid border border-secondary rounded mx-auto d-block" style="width: 200px; height: 200px;">
                                                    </div>
                                                    <p>Are you sure you want to publish this real estate listing?</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('real.handlePay', ['real' => $real->id]) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="pay" value="{{ $real->pay == 1 ? 0 : 1 }}">
                                                <button type="submit" class="btn btn-{{ $real->pay == 1 ? 'danger' : 'dark' }}">
                                                    {{ $real->pay == 1 ? 'Unpublish' : 'Publish' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="d-inline-block" action="{{ route('real.destroy', ['real' => $real->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger">Delete <i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
