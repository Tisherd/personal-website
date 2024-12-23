<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/login', function () {
        return redirect('/');
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');


    Route::get('/', [App\Http\Controllers\AboutController::class, 'index'] )->name('about');
    Route::get('/work_experience', [App\Http\Controllers\WorkExperienceController::class, 'index'] )->name('work_experience');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'] )->name('users');
});
