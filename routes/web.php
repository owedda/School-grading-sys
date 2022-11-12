<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLessonController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('users')
    ->name('users.')
    ->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('', 'store')->name('store');
    Route::delete('{id}', 'destroy')->name('destroy');
});

Route::controller(LessonController::class)
    ->prefix('lessons')
    ->name('lessons.')
    ->group(function () {
        Route::get('', 'index')->name('index');
    });

Route::controller(UserLessonController::class)
    ->prefix('userLessons')
    ->name('userLessons.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::delete('{id}', 'destroy')->name('destroy');
    });

