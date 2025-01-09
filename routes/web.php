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

    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('about_me.index');
        });

        Route::get('/about_me', [Controllers\Admin\AboutMeController::class, 'index'])->name('about_me.index');
        Route::post('/about_me', [Controllers\Admin\AboutMeController::class, 'update'])->name('about_me.update');
        Route::get('/work_experience', [Controllers\Admin\WorkExperienceController::class, 'index'])->name('work_experience.index');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('auth');
    });
});
