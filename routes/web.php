<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLessonController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::controller(UserController::class)
        ->prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{userId}/lessons', 'lessons')->name('lessons');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::controller(LessonController::class)
        ->prefix('lessons')
        ->name('lessons.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{lessonId}/users', 'users')->name('users');
        });

    Route::controller(UserLessonController::class)
        ->prefix('userLessons')
        ->name('userLessons.')
        ->group(function () {
            Route::post('', 'store')->name('store');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::controller(EvaluationController::class)
        ->prefix('evaluations')
        ->name('evaluations.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::delete('{id}', 'destroy')->name('destroy');
        });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
