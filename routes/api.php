<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    JsonApiRoute::server('v20220101')->prefix('v20220101')->resources(function ($server) {
        $server->resource('projects', JsonApiController::class)
            ->readOnly()
            ->relationships(function ($relations) {
                $relations->hasOne('team')->readOnly();
                $relations->hasMany('targets')->readOnly();
            });
    });

//    Route::resource('project', \App\Http\Controllers\Api\ProjectController::class)->only(['index', 'show']);
//    Route::resource('project.target', \App\Http\Controllers\Api\TargetController::class)->only(['show']);
//    Route::resource('project.target.environment', \App\Http\Controllers\EnvironmentController::class)->only(['show']);
});
