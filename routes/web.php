<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;


Route::get('/', [VisitController::class, 'index'])->name('home');

Route::get('/track', [VisitController::class, 'track']);

Route::get('/visits', [VisitController::class, 'visits'])->name('visits.index');

Route::get('/visits/export', [VisitController::class, 'exportCsv'])->name('visits.export');

Route::delete('/visits/{id}', [VisitController::class, 'destroy'])->name('visits.destroy');

Route::delete('/visits', [VisitController::class, 'destroyAll'])->name('visits.destroyAll');