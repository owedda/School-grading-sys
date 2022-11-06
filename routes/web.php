<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLessonController;
use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('users', UserController::class);
//Route::get('/', [UserController::class, 'index']);
//Route::get('/edit/{id}', [UserController::class, 'edit']);
//Route::get('/show/{id}', [UserController::class, 'show']);
//Route::get('/create', [UserController::class, 'create']);
//Route::post('/store', [UserController::class, 'store']);
//Route::post('/update/{id}', [UserController::class, 'update']);
//Route::delete('/{id}', [UserController::class, 'destroy']);

Route::resource('lessons', LessonController::class);
Route::resource('userLessons', UserLessonController::class);
