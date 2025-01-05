<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [Controllers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [Controllers\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/', function () {
        return redirect()->route('resume');
    });


    Route::get('/resume', [Controllers\ResumeController::class, 'index'])->name('resume');
    Route::get('/work_experience', [Controllers\WorkExperienceController::class, 'index'])->name('work_experience');

    Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');
});
