<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Virtual Tour Response</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #f8fafc, #e0f2fe);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
        }

        h1 {
            font-size: 28px;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .status {
            color: #2563eb; /* blue tone */
            font-weight: bold;
        }

        p {
            font-size: 16px;
            color: #4b5563;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 22px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>You have <span class="status">{{ $status }}</span> a virtual tour request.</h1>
        <p>Thank you for using our platform to manage your property listings.
        We appreciate your contribution to helping clients find their ideal homes.</p>
    </div>
</body>
</html>
