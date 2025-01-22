<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Deletion Confirmation</title>
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
            background-color: #dc3545;
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
            Ticket Deleted Successfully
        </div>
        <div class="content">
            <p>Name: {{ $mailData['name'] }},</p>
            <p>We regret to inform you that your ticket has been deleted successfully. Below are the details of the ticket that was removed:</p>
            <p class="ticket-info">
                Mail: {{ $mailData['email'] }}<br>
                Event: {{ $mailData['event'] }}<br>
                price Back: ${{ $mailData['price'] }}<br>
            </p>
            <p>If you believe this was done in error, please <a href="">contact us</a> immediately, and we will assist you.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Event Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
