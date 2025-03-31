<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Resume;
use App\Http\Controllers\Projects;
use App\Http\Controllers\Blog;
use App\Http\Controllers\Admin;

Route::middleware('guest')->group(function () {
    Route::inertia('/login', 'LoginPage')->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/', fn () => redirect()->route('resume.about_me.index'));

    Route::prefix('resume')->as('resume.')->group(function () {
        Route::get('/', fn () => redirect()->route('resume.about_me.index'));

        Route::get('/about_me', [Resume\AboutMeController::class, 'index'])->name('about_me.index');
        Route::get('/work_experience', [Resume\WorkExperienceController::class, 'index'])->name('work_experiences.index');
        Route::get('/skills', [Resume\SkillsController::class, 'index'])->name('skills.index');
        Route::get('/questions', [Resume\QuestionsController::class, 'index'])->name('questions.index');
    });

    Route::get('/projects', Projects\IndexController::class)
        ->name('projects.index');

    Route::prefix('blogs')->as('blogs.')->group(function () {
        Route::get('/', Blog\IndexController::class)->name('index');
        Route::post('/', Blog\StoreController::class)->name('store');
        Route::get('/infinite', Blog\LoadMoreController::class)->name('infinite');
        Route::delete('/{blog}', Blog\DeleteController::class)->name('destroy');
    });
});

Route::prefix('admin')->as('admin.')->middleware('admin')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.about_me.index'));

    Route::get('/about_me', [Admin\AboutMeController::class, 'index'])->name('about_me.index');
    Route::post('/about_me', [Admin\AboutMeController::class, 'update'])->name('about_me.update');

    Route::resource('work_experiences', Admin\WorkExperienceController::class)->names('work_experiences');
    Route::resource('projects', Admin\ProjectController::class)->names('projects');
    Route::resource('users', Admin\UserController::class)->names('users');
});
