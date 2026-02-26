<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->name('adminDashboard');
Route::get('/student', [StudentController::class, 'index'])->name('studentDashboard');
