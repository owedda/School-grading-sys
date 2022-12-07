<?php

use App\Http\Controllers\Student\EvaluationController;
use App\Http\Controllers\Teacher\LessonsController;
use App\Http\Controllers\Teacher\StudentsController;
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
        ->prefix('students')
        ->name('students.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{userId}/lessons', 'showLessons')->name('lessons');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::delete('{id}', 'destroy')->name('destroy');
            Route::post('userLesson', 'storeUserLesson')->name('storeUserLesson');
            Route::delete('userLesson/{id}', 'destroyUserLesson')->name('destroyUserLesson');
        });

    Route::controller(LessonsController::class)
        ->prefix('lessons')
        ->name('lessons.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('evaluation', 'storeUserEvaluation')->name('storeEvaluation');
            Route::delete('evaluation/{id}', 'destroyUserEvaluation')->name('destroyEvaluation');
            Route::get('{lessonId}/users', 'showUsers')->name('users');
        });
});
