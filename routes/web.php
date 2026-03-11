<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

Route::get('/', [VisitController::class, 'index']); 
Route::get('/track', [VisitController::class, 'track']);
Route::get('/visits', [VisitController::class, 'visits'])->name('visits.index');


// Route::get('/', function () {
//     return view('welcome');
// });
