<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravisit Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; min-height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); color: #fff; }
        .card-glass { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.08); border-radius: 1.5rem; box-shadow: 0 0.75rem 2rem rgba(0,0,0,0.35); padding: 3rem 2rem; max-width: 500px; width: 90%; text-align: center; }
        .btn-gradient { background: linear-gradient(90deg, #06b6d4, #3b82f6); color: #fff; font-weight: 600; padding: 0.75rem 2rem; font-size: 1.2rem; border-radius: 1rem; border: none; transition: 0.3s; }
        .btn-gradient:hover { transform: translateY(-3px); box-shadow: 0 0.75rem 1.5rem rgba(59, 130, 246, 0.7); color: white; }
        .stat-box { background: rgba(255,255,255,0.1); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; }
        .stat-value { font-size: 2.5rem; font-weight: 700; color: #ffd166; }
    </style>
</head>
<body>

    <div class="card-glass">
        <h1 class="display-4 fw-bold mb-3" style="color: #ffd166;">Laravisit</h1>
        <p class="lead mb-4">Professional real-time visitor tracking system.</p>

        <div class="stat-box">
            <p class="mb-1 text-uppercase small tracking-widest">Total Site Visits</p>
            <div class="stat-value">{{ $totalVisits ?? 0 }}</div>
        </div>

        <a href="{{ route('visits.index') }}" class="btn btn-gradient btn-lg w-100">
            View Analytics Dashboard
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>