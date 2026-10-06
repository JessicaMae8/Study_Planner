<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudyTaskController;
use App\Http\Controllers\StudySessionController;
use App\Http\Controllers\ServiceRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/requests', [ServiceRequestController::class, 'index'])
        ->name('service-requests.index');

    Route::get('/requests/create', [ServiceRequestController::class, 'create'])
        ->name('service-requests.create');

    Route::post('/requests', [ServiceRequestController::class, 'store'])
        ->name('service-requests.store');

    Route::get('/requests/{serviceRequest}', [ServiceRequestController::class, 'show'])
        ->name('service-requests.show');

    Route::patch('/requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])
        ->name('service-requests.update-status');
});

Route::resource('subjects', SubjectController::class);
Route::resource('study-tasks', StudyTaskController::class);
Route::resource('study-sessions', StudySessionController::class);