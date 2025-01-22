<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background-color: #4CAF50;
            padding: 10px;
            color: white;
            font-size: 24px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }
        .content .ticket-info {
            font-weight: bold;
            color: #007BFF;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Ticket Bought Successfully
        </div>
        <div class="content">
            <p>Name: {{ $mailData['name'] }},</p>
            <p>Thank you for your purchase! Your ticket has been successfully booked. Please find your ticket details below:</p>
            <p class="ticket-info">
                Email: {{ $mailData['email'] }}<br>
                Price: ${{ $mailData['price'] }}<br>
                Quantity: {{ $mailData['quantity'] }}<br>
                Event: {{ $mailData['event'] }}
            </p>
            <p>We look forward to seeing you at the event!</p>
        </div>
        <div class="footer">
            <p>If you have any questions, feel free to <a href="#">contact us</a></p>
            <p>&copy; 2025 Event Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
