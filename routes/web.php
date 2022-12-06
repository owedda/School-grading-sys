<?php

use App\Http\Controllers\Student\EvaluationController;
use App\Http\Controllers\Teacher\LessonsController;
use App\Http\Controllers\Teacher\StudentsController;
use App\Http\Controllers\Teacher\UserLessonController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'isStudent']], static function () {
    Route::controller(EvaluationController::class)
        ->prefix('evaluations')
        ->name('evaluations.')
        ->group(function () {
            Route::get('', 'index')->name('index');
        });
});

Route::group(['middleware' => ['auth', 'isTeacher']], static function () {
    Route::controller(StudentsController::class)
        ->prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{userId}/lessons', 'showLessons')->name('lessons');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::delete('{id}', 'destroy')->name('destroy');
        });

    Route::controller(LessonsController::class)
        ->prefix('lessons')
        ->name('lessons.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{lessonId}/users', 'showUsers')->name('users');
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
            Route::post('', 'store')->name('store');
            Route::delete('{id}', 'destroy')->name('destroy');
        });
});
