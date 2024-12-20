<?php

use App\Models\Actual;
use App\Models\Preview;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ActualController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ActionPlanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\NotificationController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('login-page');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('auth/me', [AuthController::class, 'authMe'])->name('auth.me');


Route::get('dashboard', [EmployeeController::class, 'index'])->name('dashboard');
Route::get('dashboard/filter', [EmployeeController::class, 'filter']);

Route::prefix('target')->group(function () {
    Route::get('/input-target-kpi', [TargetController::class, 'show']);
    Route::get('/input-target-employee/edit/{id}', [TargetController::class, 'edit'])->name('target.edit');
    Route::get('/input-target-department', [TargetController::class, 'department'])->name('target.department');
    Route::get('/input-target-kpi-department/edit/{id}', [TargetController::class, 'editDept'])->name('target.editDept');
    Route::get('/input-target-kpi-department', [TargetController::class, 'showDept'])->name('showDept');
    Route::get('/import-target-kpi-employee', [TargetController::class, 'showImport'])->name('target.showImport');
    Route::get('/import-target-kpi-department', [TargetController::class, 'showImportDept'])->name('target.showImportDept');
    Route::post('/import-target-kpi-employee/store', [TargetController::class, 'import'])->name('target.import');
    Route::put('/input-target-kpi/update', [TargetController::class, 'update'])->name('target.update');
    Route::put('/input-target-kpi-department/update', [TargetController::class, 'updateDept'])->name('target.updateDept');
    // Route::get('/input-target-kpi/{id}', [TargetController::class, 'show']);
});

Route::prefix('actual')->group(function () {
    Route::get('/input-actual-employee', [ActualController::class, 'show'])->name('actual.show');
    Route::get('/input-actual-department', [ActualController::class, 'department'])->name('actual.department');
    Route::get('/input-actual-achievement/edit/{id}', [ActualController::class, 'edit']);
    Route::post('/input-actual-achievement/store', [ActualController::class, 'store'])->name('actual.store');
    Route::put('/input-actual-achievement/update', [ActualController::class, 'updateActual'])->name('actual.updateActual');
    Route::put('/input-actual-achievement/updateDept', [ActualController::class, 'updateActualDept'])->name('actual.updateActualDept');
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
    Route::get('/file-preview', [ReportController::class, 'showFile'])->name('report.showFile');
    Route::get('/file-preview-dept', [ReportController::class, 'showFileDept'])->name('report.showFileDept');
});

Route::prefix('logs')->group(function () {
    Route::get('/log-check', [LogController::class, 'index'])->name('log-check.index');
    Route::get('/log-input', [LogController::class, 'indexInput'])->name('log-input.indexInput');
    Route::get('/log-input-individual', [LogController::class, 'individual'])->name('log-input.individual');
});

Route::prefix('action-plan')->group(function () {
    Route::get('/action-plans', [ActionPlanController::class, 'show'])->name('action-plan.show');
    Route::get('/input-action-plan/{id}', [ActionPlanController::class, 'addEmployeeFile'])->name('action-plan.addEmployeeFile');
    Route::post('/input-action-plan/store', [ActionPlanController::class, 'storeFile']);
    Route::get('/file-preview/{id}', [ActionPlanController::class, 'showFile'])->name('action-plan.showFile');
    Route::get('/input-action-plan/edit/{id}', [ActionPlanController::class, 'editFile']);
    Route::put('/input-action-plan/update/{id}', [ActionPlanController::class, 'updateFile']);
});
Route::prefix('kpi-requirement')->group(function () {
    Route::get('/view-requirement', [RequirementController::class, 'index'])->name('index');
    Route::get('/create-requirement', [RequirementController::class, 'create'])->name('create');
    Route::post('/create-requirement/store', [RequirementController::class, 'store'])->name('store');
});

Route::prefix('notifications')->group(function () {
    Route::get('/all', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/create', [NotificationController::class, 'create'])->name('notification.create');
    Route::post('/store', [NotificationController::class, 'store'])->name('notification.store');
});

Route::get('generate-pdf-input', [GeneratePdfController::class, 'generatePdfInput'])->name('generatePdfInput');

Route::get('404-not-found', function () {
    return view('components/404-page');
})->name('404-page');
