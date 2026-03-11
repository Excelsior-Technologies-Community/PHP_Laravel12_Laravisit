<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravisit Home</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Body Gradient Background */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism Card */
        .card-glass {
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 1.5rem;
            box-shadow: 0 0.75rem 2rem rgba(0,0,0,0.35);
            padding: 4rem 2rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        /* Heading */
        h1.display-4 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #ffd166;
        }

        /* Lead Text */
        p.lead {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #f1f1f1;
        }

        /* Gradient Button */
        .btn-gradient {
            background: linear-gradient(90deg, #06b6d4, #3b82f6);
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 2rem;
            font-size: 1.2rem;
            border-radius: 1rem;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 0.5rem 1rem rgba(59, 130, 246, 0.5);
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.75rem 1.5rem rgba(59, 130, 246, 0.7);
        }
    </style>
</head>
<body>

    <div class="card-glass">
        <h1 class="display-4">Welcome to Laravisit</h1>
        <p class="lead">Track your website visits in real-time with a modern dashboard view.</p>
        <a href="{{ route('visits.index') }}" class="btn btn-gradient btn-lg">View Visits</a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>