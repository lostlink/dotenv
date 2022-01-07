<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

if (! function_exists('currentTeam')) {
    function currentTeam($attribute = null)
    {
        if ($attribute) {
            return request()->user()->currentTeam->getAttribute($attribute);
        }

        return request()->user()->currentTeam;
    }
}

if (! function_exists('isBinary')) {
    function isBinary($str): bool
    {
        return preg_match('~[^\x20-\x7E\t\r\n]~', $str) > 0;
    }
}


if (! function_exists('option')) {
    function option($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('option');
        }

        if (is_array($key)) {
            return app('option')->set($key);
        }

        return app('option')->get($key, $default);
    }
}

if (! function_exists('option_exists')) {
    function option_exists($key)
    {
        return app('option')->exists($key);
    }
}
if (! function_exists('whoisInfo')) {
    function whoisInfo(string $domain)
    {
        return Cache::remember($domain, Carbon::now()->addMinutes(10), fn () => Http::get(
            config('_app.whoisxmlapi.url'),
            [
                'domainName' => $domain,
                'apiKey' => config('_app.whoisxmlapi.key'),
                'outputFormat' => 'JSON',
            ]
        )->json());
    }
}
