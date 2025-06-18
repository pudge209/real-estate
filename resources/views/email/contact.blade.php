<!-- resources/views/emails/contact.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body>
    <h1>New message from {{ $name }}</h1>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    <p><strong>Message:</strong><br>{{ nl2br(e($userMessage)) }}</p>
</body>
</html>
