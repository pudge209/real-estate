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
    <title>Syrian Estate</title>
</head>
<body>

    @php
    if (Auth::check()) {
        $roleType = Auth::user()->role;
        switch ($roleType) {
            case '1':
                header("Location: " . route('admin.dashboard'));
                exit();
            case '2':
                header("Location: " . route('client.dashboard'));
                exit();
            case '3':
                header("Location: " . route('dashboard'));
                exit();
            default:
                header("Location: " . route('vendor.dashboard'));
                exit();
        }
    }
    @endphp

    @include("nav")

    @extends('master')
    @section('master')
        @include('search')
        <div class="container">
            @include('real.card')
        </div>
    @endsection

</body>
</html>
