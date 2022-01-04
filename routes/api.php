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

    Route::get('{project:slug}/{target:slug}/{environment:slug}', \App\Http\Controllers\Api\EnvController::class)
    ->name('project.target.environment')
    ->scopeBindings();
});
