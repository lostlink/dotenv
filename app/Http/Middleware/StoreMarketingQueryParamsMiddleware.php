<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StoreMarketingQueryParamsMiddleware
{
    public function handle($request, Closure $next): mixed
    {
        $utmQueryParams = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
        ];
        foreach ($utmQueryParams as $utmQueryParam) {
            if ($request->has($utmQueryParam)) {
                session()->put($utmQueryParam, $request->input($utmQueryParam));
            }
        }

        return $next($request);
    }
}
