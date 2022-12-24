<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class EnvParser
{
    public static function toEnv(?array $data): string
    {
        return collect($data)
            ->map(fn ($content, $variable) => implode('=', [$variable, $content]))
            ->implode(PHP_EOL);
    }

    public static function toArray(?string $data): array
    {
        if (is_null($data)) {
            return [];
        }

        return collect(explode(PHP_EOL, $data))
            ->filter()
            ->reject(fn ($value) => Str::startsWith($value, '#'))
            ->whenNotEmpty(function ($collection) {
                return $collection->flatMap(function ($env) {
                    [$variable, $content] = [Str::before($env, '='), Str::after($env, '=')];

                    return [$variable => $content];
                });
            })
            ->toArray();
    }
}
