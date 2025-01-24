<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::middleware('guest')->group(function () {
    Route::get('/login', [Controllers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [Controllers\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/', function () {
        return redirect()->route('resume.about_me.index');
    });

    Route::prefix('resume')->as('resume.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('resume.about_me.index');
        });

        Route::get('/about_me', [Controllers\Resume\AboutMeController::class, 'index'])
            ->name('about_me.index');

        Route::get('/work_experience', [Controllers\Resume\WorkExperienceController::class, 'index'])
            ->name('work_experiences.index');

        Route::get('/skills', [Controllers\Resume\SkillsController::class, 'index'])
            ->name('skills.index');

        Route::get('/questions', [Controllers\Resume\QuestionsController::class, 'index'])
            ->name('questions.index');
    });

    Route::get('/projects', Controllers\Projects\IndexController::class)
        ->name('projects.index');

    Route::get('/sandbox', Controllers\Sandbox\IndexController::class)
        ->name('sandbox.index');

    Route::get('/blog', Controllers\Blog\IndexController::class)
        ->name('blog.index');
});

Route::prefix('admin')->as('admin.')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.about_me.index');
    });

    Route::get('/about_me', [Controllers\Admin\AboutMeController::class, 'index'])
        ->name('about_me.index');
    Route::post('/about_me', [Controllers\Admin\AboutMeController::class, 'update'])
        ->name('about_me.update');

    Route::resource('work_experiences', Controllers\Admin\WorkExperienceController::class)
        ->names('work_experiences');
    Route::resource('projects', Controllers\Admin\ProjectController::class)
        ->names('projects');
    Route::resource('users', Controllers\Admin\UserController::class)
        ->names('users');
});
