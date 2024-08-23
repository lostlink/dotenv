<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class StoreMarketingQueryParamsMiddleware
{
    public function handle(Request $request, Closure $next): mixed
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
                $request->session()->put($utmQueryParam, $request->input($utmQueryParam));
            }
        }

        return $next($request);
    }
}
