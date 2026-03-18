<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Server Down</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZmCULaM6tU8zTtIKxXvYV8zMMn3K1fVx7XWExJQ5q+6d5eVb1H3yD9j6j6g7Sk3O9cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            transition: background 0.5s, color 0.5s;
        }

        body.day-mode {
            background-color: #f8f9fa;
            color: #333;
        }

        body.night-mode {
            background-color: #1c1c1c;
            color: #f1f1f1;
        }

        .container {
            max-width: 700px;
            margin: 80px auto;
            background: inherit;
            border-radius: 12px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s forwards;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        p {
            color: inherit;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer {
            margin-top: 20px;
            color: inherit;
            font-size: 0.95rem;
        }

        .toggle-btn {
            margin-top: 25px;
            padding: 10px 22px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
        }

        body.day-mode .toggle-btn {
            background-color: #e74c3c;
            color: #fff;
        }

        body.night-mode .toggle-btn {
            background-color: #f1f1f1;
            color: #1c1c1c;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="day-mode">

    <div class="container">
        <h1><i class="fas fa-server"></i> Server is Down</h1>
        <p>We are unable to process your request at the moment. The server might be temporarily unavailable.</p>
        <p>Please try again later or contact support if the issue persists.</p>

        <div class="footer">
            Thank you for your patience.
        </div>

        <button class="toggle-btn" onclick="toggleMode()">
            <i class="fas fa-adjust"></i> Switch Night/Day Mode
        </button>
    </div>

    <script>
        function toggleMode() {
            const body = document.body;
            body.classList.toggle('day-mode');
            body.classList.toggle('night-mode');
        }
    </script>
</body>

</html>
