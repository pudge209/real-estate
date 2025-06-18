<!DOCTYPE html>
<html>
<head>
    <title>Virtual Tour Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        h1 {
            font-size: 24px;
            color: #007bff;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 15px 0;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 5px;
            font-size: 16px;
        }
        a.reject {
            background-color: #dc3545;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Hello, {{ $publisher->name }}</h1>
        <p>{{ $loggedInUser->name }} is interested in a virtual tour of your estate with ID: {{ $estateId }}.</p>
        <p>Please let us know if you would like to accept or reject this request by clicking one of the options below:</p>
        <div style="text-align: center;">
            <a href="{{ url('/virtual-tour/accept/' . $estateId . '/' . $loggedInUser->id) }}">Accept</a>
            <a href="{{ url('/virtual-tour/reject/' . $estateId . '/' . $loggedInUser->id) }}" class="reject">Reject</a>
        </div>
        <p class="footer">If you have any questions, feel free to reply to this email.</p>
    </div>
</body>
</html>
