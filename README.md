# PHP_Laravel12_Laravisit

## Introduction

PHP_Laravel12_Laravisit is a modern Laravel 12 project designed to track and manage website visits. The system automatically records visitor information, including IP address, browser user agent, and the visited URL. All collected data is stored in a database and displayed in a responsive, user-friendly dashboard.

This project demonstrates best practices in Laravel development, including:

- Database migrations and models

- Controller-based routing

- Blade templates with a modern 2026-style premium UI

- Visitor tracking system with pagination and responsive tables

- Clean and maintainable project structure

It is ideal for learning visitor tracking, Laravel routing, and modern front-end integration using Bootstrap 5.

---

## Project Overview

Laravisit consists of the following components:

#### 1) Visitor Model (Visit.php)

- Handles the data structure and interactions with the visits table.

#### 2) Visit Controller (VisitController.php)

Contains logic for:

- Displaying the homepage

- Recording visitor details automatically

- Showing all visits in a paginated dashboard

#### 3) Database Migration (xxxx_create_visits_table.php)

Creates the visits table with fields for:

- ID

- IP address

- User agent

- URL visited

- Timestamps

#### 4) Blade Views

- home.blade.php → Premium landing page with gradient + glassmorphism design

- visits/index.blade.php → Visitor logs dashboard with Bootstrap tables and pagination

#### 5) Routes (web.php)

- / → Homepage

- /track → Automatically track visitor

- /visits → Display all visits

#### 6) Front-End Design

- Uses Bootstrap 5, glassmorphism, and gradient backgrounds for a clean and modern dashboard experience.

#### 7) Pagination and Responsive Design

- Visitor logs are displayed in a responsive table with pagination for easy navigation.

---

## Project Requirements

- PHP >= 8.1

- Composer

- MySQL / MariaDB

- Laravel 12

---

## Step 1: Create the Laravel Project

Open terminal / command prompt and run:

```bash
composer create-project laravel/laravel PHP_Laravel12_Laravisit "12.*"
cd PHP_Laravel12_Laravisit
```

This will create a new Laravel 12 project with the name PHP_Laravel12_Laravisit.

---

## Step 2: Configure Environment

Update .env file with your database configuration:

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravisit_db
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate
```

---

## Step 3: Migration Table

Then create migration files for visitors table:

```bash
php artisan make:migration create_visits_table --create=visits
```
Update database/migrations/xxxx_create_visits_table.php:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('visits');
    }
};
```

Run migration:

```bash
php artisan migrate
```
---

## Step 4: Create Visitor Model

```bash
php artisan make:model Visit
```
app/Models/Visit.php:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
    ];
}
```
---

## Step 5: Create Controller

```bash
php artisan make:controller VisitController
```
app/Http/Controllers/VisitController.php:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    // Show homepage
    public function index()
    {
        return view('home'); 
    }

    // Track visitor
    public function track(Request $request)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
        ]);

        return response()->json(['message' => 'Visit tracked successfully']);
    }

    // Display all visits
    public function visits()
    {
        $visits = Visit::latest()->paginate(20);
        return view('visits.index', compact('visits'));
    }
}
```
---

## Step 6: Create Routes

routes/web.php:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

Route::get('/', [VisitController::class, 'index']); 
Route::get('/track', [VisitController::class, 'track']);
Route::get('/visits', [VisitController::class, 'visits'])->name('visits.index');
```

---

## Step 7: Create Blade Views

### home.blade.php

resources/views/home.blade.php:

```blade
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
```

### index.blade.php

resources/views/visits/index.blade.php:

```blade
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
```

---

## Step 8: Test the Project

1) Start Laravel server:

```bash
php artisan serve
```

2) Visit http://127.0.0.1:8000/ → homepage

3) Visit http://127.0.0.1:8000/track → record visit

4) Visit http://127.0.0.1:8000/visits → view all recorded visits

---

## Output

### Home Page

<img width="1919" height="1026" alt="Screenshot 2026-03-11 142639" src="https://github.com/user-attachments/assets/5a0a9d52-4a63-4892-b44f-c98eba03907a" />

### Record Track

<img width="1826" height="1084" alt="Screenshot 2026-03-11 142712" src="https://github.com/user-attachments/assets/25785982-1c6c-4c6a-8fe2-75fc75173087" />

### Index Page

<img width="1918" height="1027" alt="Screenshot 2026-03-11 142748" src="https://github.com/user-attachments/assets/67e31c18-2e58-4e9b-a249-c2cf027e2c06" />

---

## Project Structure

```
PHP_Laravel12_Laravisit/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── VisitController.php       # Controller handling visit logic
│   └── Models/
│       └── Visit.php                      # Visit model
├── database/
│   ├── migrations/
│   │   └── xxxx_create_visits_table.php   # Visits table migration
│   └── seeders/                           # Optional: add seeders if needed
├── resources/
│   ├── views/
│   │   ├── home.blade.php                 # Homepage with premium design
│   │   └── visits/
│   │       └── index.blade.php            # All visits page with premium design
├── routes/
│   └── web.php                             # All web routes
├── config/
├── vendor/
├── public/
│   ├── css/
│   │   └── app.css                         # Optional custom CSS
│   └── js/                                 # Optional custom JS
├── .env
├── artisan
├── composer.json
├── composer.lock
├── package.json
└── README.md                               # Project documentation                        
```

---

Your PHP_Laravel12_Laravisit Project is now ready!

