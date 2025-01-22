<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 20px 10px;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
            color: #333333;
        }

        .email-body p {
            line-height: 1.6;
        }

        .email-body .highlight {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin: 10px 0;
            font-family: 'Courier New', Courier, monospace;
        }

        .email-footer {
            background-color: #f4f4f9;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
        }

        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            Your Login Info, secure
        </div>
        <div class="email-body">
            <p>Hi,</p>
            <p>You recently requested to login info. Below are your login details:</p>
            <div class="highlight">
                <strong>Email:</strong> {{ $mailData['email'] }}<br>
                <strong>Password:</strong> {{ $mailData['password'] }}
            </div>
            <p>We recommend that you change your password after logging in for enhanced security.</p>
            <p>If you did not request this, please ignore this email or contact support immediately.</p>
        </div>
        <div class="email-footer">
            &copy; 2025 Your Company Name. All rights reserved. <br>
            <a href="#">Privacy Policy</a> | <a href="#">Contact Support</a>
        </div>
    </div>
</body>
</html>
