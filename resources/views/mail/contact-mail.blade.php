<!-- resources/views/mail/contact-mail.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
        }
        .header {
            background-color: #007bff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            margin: 15px 0;
            line-height: 1.6;
        }
        .content p strong {
            color: #007bff;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>New Contact Message</h1>
        </div>
        <div class="content">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Subject:</strong> {{ $mailSubject }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $content }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Food_Park All rights reserved.</p>
        </div>
    </div>
</body>
</html>
