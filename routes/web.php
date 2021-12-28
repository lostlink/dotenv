<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('project', \App\Http\Controllers\ProjectController::class)->only(['index', 'show']);
    Route::resource('project.target', \App\Http\Controllers\TargetController::class)->only(['show']);
//    Route::resource('project.target.environment', \App\Http\Controllers\EnvironmentController::class)->only(['show']);
});
