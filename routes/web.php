<?php

use App\Http\Controllers\TargetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard', 'desc' => 'Analytics']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard', 'desc' => 'Analytics']);
});

Route::resource('/target/input-target-employee', TargetController::class);
Route::resource('/target/input-target-kpi', TargetController::class);

Route::get('/actual/input-actual-employee', function () {
    return view('/actual/input-actual-employee', ['title' => 'Input Data Realisasi', 'desc' => 'Achievement']);
});

Route::get('/actual/input-actual-achievement', function () {
    return view('/actual/input-actual-achievement', ['title' => 'Input Data Realisasi', 'desc' => 'Achievement']);
});

Route::get('/log-input', function () {
    return view('log-input', ['title' => 'Log Input', 'desc' => 'History']);
});
