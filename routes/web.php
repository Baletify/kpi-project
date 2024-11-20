<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ActionPlanController;
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
    Route::get('/input-target-department', [TargetController::class, 'department'])->name('target.department');
    Route::get('/input-target-kpi-department', [TargetController::class, 'showDept'])->name('showDept');
    // Route::get('/input-target-kpi/{id}', [TargetController::class, 'show']);
});

Route::prefix('actual')->group(function () {
    Route::get('/input-actual-employee', [ActualController::class, 'show'])->name('actual.show');
    Route::get('/input-actual-department', [ActualController::class, 'department'])->name('actual.department');
    Route::get('/input-actual-achievement/edit/{id}', [ActualController::class, 'edit']);
    Route::post('/input-actual-achievement/store', [ActualController::class, 'store'])->name('actual.store');
    Route::put('/input-actual-achievement/update', [ReportController::class, 'updateActual'])->name('report.updateActual');
    // Preview
    Route::post('/preview/store', [PreviewController::class, 'store']);
    Route::get('/preview/{id}/{kpi_code}', [PreviewController::class, 'show'])->name('preview.show');
    Route::get('/preview/{id}/{kpi_code}/filter', [PreviewController::class, 'filter']);
    // Preview End
    // Actual Dept
    Route::get('/input-actual-department-details', [ActualController::class, 'showDept'])->name('actual.showDept');
    Route::get('/input-actual-department-achievement/edit/{id}', [ActualController::class, 'editDept']);
    Route::post('/input-actual-department-achievement/store', [ActualController::class, 'storeDept'])->name('actual.storeDept');
});

Route::prefix('report')->group(function () {
    Route::get('/list-employee-report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/employee-report/{id}', [ReportController::class, 'show'])->name('report.show');
    Route::get('/summary-department-report', [ReportController::class, 'summaryDept'])->name('report.summaryDept');
    Route::get('/department-report/{id}', [ReportController::class, 'department'])->name('report.department');
    Route::get('/file-preview/{id}', [ReportController::class, 'showFile'])->name('report.showFile');
});

Route::get('/log-check', [LogController::class, 'index'])->name('log-check.index');
Route::get('/log-input', [LogController::class, 'indexInput'])->name('log-check.indexInput');
Route::prefix('action-plan')->group(function () {
    Route::get('/action-plans', [ActionPlanController::class, 'show'])->name('action-plan.show');
    Route::get('/input-action-plan/{id}', [ActionPlanController::class, 'addEmployeeFile'])->name('action-plan.addEmployeeFile');
    Route::post('/input-action-plan/store', [ActionPlanController::class, 'storeFile']);
    Route::get('/file-preview/{id}', [ActionPlanController::class, 'showFile'])->name('action-plan.showFile');
    Route::get('/input-action-plan/edit/{id}', [ActionPlanController::class, 'editFile']);
    Route::put('/input-action-plan/update/{id}', [ActionPlanController::class, 'updateFile']);
});
