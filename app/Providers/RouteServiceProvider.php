<?php

namespace App\Providers;

use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        Route::bind('project', function ($value) {
            return Project::where('id', $value)->orWhere('slug', $value)->first();
        });

        Route::bind('target', function ($value) {
            return Target::where('id', $value)->orWhere('slug', $value)->first();
        });

        Route::bind('environment', function ($value) {
            return Environment::where('id', $value)->orWhere('slug', $value)->first();
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
