<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudyTaskController;
use App\Http\Controllers\StudySessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('subjects', SubjectController::class);
Route::resource('study-tasks', StudyTaskController::class);
Route::resource('study-sessions', StudySessionController::class);