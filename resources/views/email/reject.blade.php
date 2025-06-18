<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estate Request Rejected</title>
</head>
<body>
    <h1>Hello, {{ $loggedInUser->name }}</h1>
    <p>{{ $requester->name }}'s request to purchase the estate with ID {{ $estateId }} has been rejected.</p>
    <p>Thank you for your attention.</p>
    <p>Best regards,</p>
    <p>Your Real Estate Team</p>
</body>
</html>
