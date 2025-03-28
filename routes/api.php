<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\AuthenticateToken;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthenticateToken::class])->group(function () {
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
});

