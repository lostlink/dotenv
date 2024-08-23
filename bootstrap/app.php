<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(RouteServiceProvider::HOME);

        $middleware->append(\Fruitcake\Cors\HandleCors::class);

        $middleware->web(\Laravel\Jetstream\Http\Middleware\AuthenticateSession::class);

        $middleware->throttleApi();

        $middleware->alias([
            'store-marketing-query-params' => \App\Http\Middleware\StoreMarketingQueryParamsMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
