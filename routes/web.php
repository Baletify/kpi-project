<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\TargetController;
use App\Models\Actual;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard', 'desc' => 'Analytics']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard', 'desc' => 'Analytics']);
});

Route::prefix('target')->group(function () {
    Route::get('/input-target-kpi/{id}', [TargetController::class, 'show']);
    // Route::get('/input-target-kpi/{id}', [TargetController::class, 'show']);
});

Route::prefix('actual')->group(function () {
    Route::get('/input-actual-employee/{id}', [ActualController::class, 'show'])->name('actual.show');
    Route::get('/input-actual-achievement/edit/{id}', [ActualController::class, 'edit']);
    Route::post('/input-actual-achievement/store', [ActualController::class, 'store']);
});

Route::get('/log-input', function () {
    return view('log-input', ['title' => 'Log Input', 'desc' => 'History']);
});
