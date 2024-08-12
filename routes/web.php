<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('/task', TaskController::class);

Route::get('/edit', function () {
    return view('task.edit');
});
