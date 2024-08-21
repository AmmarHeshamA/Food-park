<!-- resources/views/mail/newsletter.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mailSubject }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
        }
        .header {
            background-color: #007bff;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #ffffff;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.8;
            margin: 10px 0;
            font-size: 16px;
        }
        .content h2 {
            color: #007bff;
            font-size: 22px;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ $mailSubject }}</h1>
        </div>
        <div class="content">
            <h2>Message:</h2>
            <p>{!! $mailMessage !!}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
