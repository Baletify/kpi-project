<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TargetController;
use App\Models\Actual;
use App\Models\Preview;
use App\Http\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard', 'desc' => 'Analytics']);
});
Route::get('dashboard', [EmployeeController::class, 'index'])->name('dashboard');
Route::get('dashboard/filter', [EmployeeController::class, 'filter']);

Route::prefix('target')->group(function () {
    Route::get('/input-target-kpi', [TargetController::class, 'show']);
    // Route::get('/input-target-kpi/{id}', [TargetController::class, 'show']);
});

Route::prefix('actual')->group(function () {
    Route::get('/input-actual-employee', [ActualController::class, 'show'])->name('actual.show');
    Route::get('/input-actual-achievement/edit/{id}', [ActualController::class, 'edit']);
    Route::post('/input-actual-achievement/store', [ActualController::class, 'store'])->name('actual.store');
    Route::post('/preview/store', [PreviewController::class, 'store']);
    Route::get('/preview/{id}', [PreviewController::class, 'show'])->name('preview.show');
});

Route::prefix('report')->group(function () {
    Route::get('/employee-report/{id}', [ReportController::class, 'show'])->name('report.show');
    Route::get('/department-report', [ReportController::class, 'department'])->name('report.department');
});

Route::get('/log-input', function () {
    return view('log-input', ['title' => 'Log Input', 'desc' => 'History']);
});
