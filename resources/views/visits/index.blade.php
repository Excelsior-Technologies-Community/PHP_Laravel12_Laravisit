<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Visits - Laravisit</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            padding: 2rem 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card-glass {
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 1.5rem;
            box-shadow: 0 0.75rem 2rem rgba(0,0,0,0.35);
        }

        .card-header {
            background: linear-gradient(90deg, #06b6d4, #3b82f6);
            color: #fff;
            font-weight: 600;
            font-size: 1.5rem;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }

        table th {
            font-weight: 600;
        }

        table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        td.text-truncate {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .pagination li a {
            border-radius: 0.5rem !important;
        }

        .no-data {
            font-size: 1.1rem;
            color: #f1f1f1;
            text-align: center;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card card-glass shadow">
        <div class="card-header text-center">
            Visitor Logs
        </div>
        <div class="card-body">
            @if($visits->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center text-white">
                    <thead class="table-light text-dark">
                        <tr>
                            <th>ID</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>URL</th>
                            <th>Visited At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visits as $visit)
                        <tr>
                            <td>{{ $visit->id }}</td>
                            <td>{{ $visit->ip_address }}</td>
                            <td class="text-start text-truncate">{{ $visit->user_agent }}</td>
                            <td class="text-start text-truncate">{{ $visit->url }}</td>
                            <td>{{ $visit->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $visits->links('pagination::bootstrap-5') }}
            </div>
            @else
            <div class="no-data">No visits found.</div>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>