<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('{project:slug}/{target:slug}/{environment:slug}', \App\Http\Controllers\Api\EnvController::class)
    ->name('project.target.environment')
    ->scopeBindings();
});
