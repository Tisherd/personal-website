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
});

Route::prefix('resume')->as('resume.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('resume.about_me.index');
    });

    Route::get('/about_me', [Controllers\Resume\AboutMeController::class, 'index'])->name('about_me.index');
    Route::get('/work_experience', [Controllers\Resume\WorkExperienceController::class, 'index'])->name('work_experience.index');
    Route::get('/skills', [Controllers\Resume\SkillsController::class, 'index'])->name('skills.index');
    Route::get('/questions', [Controllers\Resume\WorkExperienceController::class, 'index'])->name('questions.index');
});


Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.about_me.index');
    });

    Route::get('/about_me', [Controllers\Admin\AboutMeController::class, 'index'])->name('about_me.index');
    Route::post('/about_me', [Controllers\Admin\AboutMeController::class, 'update'])->name('about_me.update');

    Route::resource('work_experiences', Controllers\Admin\WorkExperienceController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});
