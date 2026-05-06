<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

Route::get('/', [VisitController::class, 'index']);

Route::get('/track', [VisitController::class, 'track']);

Route::get('/visits', [VisitController::class, 'visits'])->name('visits.index');

// ✅ NEW: delete single visit
Route::delete('/visits/{id}', [VisitController::class, 'destroy'])->name('visits.destroy');

// ✅ NEW: delete all visits
Route::delete('/visits', [VisitController::class, 'destroyAll'])->name('visits.destroyAll');