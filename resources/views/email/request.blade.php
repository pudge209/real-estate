
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estate Notification</title>
</head>
<body>
    <h1>Hello, {{ $publisher->name }}</h1>
    <p>{{ $loggedInUser->name }} has inquired about your estate.</p>
    <p>They are very interested in buying it.</p>

    <p>Click the button below to accept the request and delete the estate from the listings:</p>
    <a href="{{ route('estate.delete', ['estateId' => $estateId]) }}"
    style="background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border: none; border-radius: 5px;">
        Accept to buy
    </a>

    <p>Or click the button below to reject the request:</p>
    <a href="{{ route('estate.reject', ['estateId' => $estateId]) }}"
    style="background-color: #f44336; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border: none; border-radius: 5px;">
        Reject
    </a>

    <p>Thank you!</p>
</body>
</html>
