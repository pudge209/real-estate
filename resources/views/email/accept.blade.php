<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estate Request accepted</title>
</head>
<body>
    <h1>Hello, {{ $requester->name }}</h1>
    <p>We are happy to inform you that your request to purchase the estate with ID {{ $estateId }} has been accepted by {{ $loggedInUser->name }}.</p>
    <p>Thank you for your interest.</p>
    <p>Best regards,</p>
    <p>Your Real Estate Team</p>
</body>
</html>
