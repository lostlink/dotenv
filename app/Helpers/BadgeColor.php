<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class BadgeColor
{
    public static function get($modelColor): ?string
    {
        if (is_null($modelColor)) {
            return null;
        }

        return match ($modelColor) {
            'green' => 'bg-green-100 text-green-800',
            'yellow' => 'bg-amber-100 text-amber-800',
            'red' => 'bg-red-100 text-red-800',
            default => 'bg-indigo-100 text-indigo-800',
        };
    }

    public static function guess($modelName): string
    {
        $modelName = Str::lower($modelName);

        if (Str::contains($modelName, ['prod', 'production'])) {
            return 'bg-red-100 text-red-800';
        }

        if (Str::contains($modelName, 'staging')) {
            return 'bg-amber-100 text-amber-800';
        }

        if (Str::contains($modelName, ['dev', 'develop', 'development', 'local'])) {
            return 'bg-green-100 text-green-800';
        }

        return 'bg-indigo-100 text-indigo-800';
    }
}
