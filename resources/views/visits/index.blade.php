<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Logs Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); min-height: 100vh; padding: 40px 0; font-family: 'Inter', sans-serif; }
        .card-glass { backdrop-filter: blur(25px); background: rgba(255, 255, 255, 0.08); border-radius: 20px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4); overflow: hidden; color: white; }
        .stat-card { background: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 15px; text-align: center; }
        .btn-primary { background: linear-gradient(90deg, #00c6ff, #0072ff); border: none; }
        .text-truncate { max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        table { border-radius: 12px; overflow: hidden; }
        thead { background: rgba(255, 255, 255, 0.1); }
        td { color: #fff; }
    </style>
</head>
<body>

<div class="container">
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="stat-card card-glass">
                <h5>Total Visits</h5>
                <h3>{{ $stats['total'] }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-glass">
                <h5>Unique IPs</h5>
                <h3>{{ $stats['unique_ips'] }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-glass">
                <h5>Top Page</h5>
                <h6 class="text-truncate">{{ $stats['top_url'] ? $stats['top_url']->page_url : 'N/A' }}</h6>
            </div>
        </div>
    </div>

    <div class="card card-glass">
        <div class="card-header p-3 text-center fw-bold bg-primary text-white">🚀 Visitor Logs Dashboard</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="GET" class="row g-2 mb-4">
                <div class="col-md-3">
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search IP or URL...">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-6 d-flex gap-2">
                    <button class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('visits.index') }}" class="btn btn-secondary">Reset</a>
                    <a href="{{ route('visits.export') }}" class="btn btn-success">Export</a>
                    <button type="submit" formaction="{{ route('visits.destroyAll') }}" formmethod="POST" onclick="return confirm('Clear all?')" class="btn btn-danger">Clear</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th><th>IP</th><th>URL</th><th>Time</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td>{{ $visit->id }}</td>
                                <td>{{ $visit->ip_address }}</td>
                                <td class="text-truncate text-start">{{ $visit->page_url }}</td>
                                <td>{{ $visit->created_at->format('d M, H:i') }}</td>
                                <td>
                                    <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $visits->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

</body>
</html>