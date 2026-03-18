<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    hello
    <p>Dear {{ $senderName ?? 'Customer' }},</p>
    <p>email {{ $senderEmail }}</p>
    <p>We have received your message:</p>
    <blockquote>
        {{ $messageBody }}
    </blockquote>
    <p>We will get back to you shortly.</p>
    <p>Best regards,<br>Your Company Name</p>

</body>
</html>
