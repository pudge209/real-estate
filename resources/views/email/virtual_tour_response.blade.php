<!DOCTYPE html>
<html>
<head>
    <title>Virtual Tour Request Response</title>
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
            text-align: center;
        }
        h1 {
            font-size: 24px;
            color: {{ $status == 'accepted' ? '#28a745' : '#dc3545' }};
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 15px 0;
        }
        .status-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: {{ $status == 'accepted' ? '#28a745' : '#dc3545' }};
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="status-icon">
            @if($status == 'accepted')
                &#x2714; <!-- Check mark icon -->
            @else
                &#x274C; <!-- Cross mark icon -->
            @endif
        </div>
        <h1>Your virtual tourrrrrrrrrr request has been {{ ucfirst($status) }}.</h1>
        <p>Your request for a virtual tour of the estate with ID: {{ $estate->id }} has been {{ $status }} by the publisher.</p>
        <p class="footer">Thank you for using our services. If you have any further questions, feel free to contact us.</p>
    </div>
</body>
</html>
