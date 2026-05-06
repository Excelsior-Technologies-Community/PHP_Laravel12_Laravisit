<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Visits - Laravisit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            padding: 40px 0;
        }

        /* CARD */
        .card-glass {
            backdrop-filter: blur(25px);
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        /* HEADER */
        .card-header {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            color: white;
            font-size: 22px;
            font-weight: 700;
            padding: 18px;
            text-align: center;
        }

        /* INPUT */
        .form-control {
            border-radius: 12px;
            border: none;
            padding: 10px 14px;
            transition: 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
        }

        /* BUTTONS */
        .btn {
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 114, 255, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            opacity: 0.85;
        }

        .btn-danger {
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
            border: none;
        }

        .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(255, 65, 108, 0.3);
        }

        /* TABLE */
        table {
            border-radius: 12px;
            overflow: hidden;
        }

        thead {
            background: #f8f9fa;
        }

        tbody tr {
            transition: 0.3s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.01);
        }

        td {
            color: #fff;
        }

        /* TRUNCATE */
        .text-truncate {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
        }

        /* NO DATA */
        .no-data {
            color: white;
            text-align: center;
            padding: 30px;
            font-size: 18px;
        }

        /* PAGINATION */
        .pagination {
            gap: 5px;
        }

        .pagination li a {
            border-radius: 10px !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card card-glass">

            <div class="card-header">
                🚀 Visitor Logs Dashboard
            </div>

            <div class="card-body">

                <!-- ALERT -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- SEARCH -->
                <form method="GET" class="d-flex gap-2 mb-4">

                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="🔍 Search IP, URL, Browser, ID...">

                    <button class="btn btn-primary">Search</button>

                    <a href="{{ route('visits.index') }}" class="btn btn-secondary">Reset</a>

                    <!-- DELETE ALL -->
                    <button type="submit" formaction="{{ route('visits.destroyAll') }}" formmethod="POST"
                        onclick="return confirm('Delete all visits?')" class="btn btn-danger">

                        @csrf
                        @method('DELETE')
                        Delete All
                    </button>

                </form>

                <!-- TABLE -->
                @if($visits->count() > 0)

                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP</th>
                                    <th>User Agent</th>
                                    <th>URL</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($visits as $visit)
                                    <tr>
                                        <td>{{ $visit->id }}</td>
                                        <td>{{ $visit->ip_address }}</td>
                                        <td class="text-truncate text-start">{{ $visit->user_agent }}</td>
                                        <td class="text-truncate text-start">{{ $visit->url }}</td>
                                        <td>{{ $visit->created_at->format('d M Y, h:i A') }}</td>

                                        <td>
                                            <form action="{{ route('visits.destroy', $visit->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this visit?')">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $visits->links('pagination::bootstrap-5') }}
                    </div>

                @else
                    <div class="no-data">No visits found</div>
                @endif

            </div>

        </div>
    </div>

</body>

</html>