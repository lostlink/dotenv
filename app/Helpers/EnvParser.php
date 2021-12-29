<?php

namespace App\Helpers;

class EnvParser
{
    public static function toEnv(?array $data): string
    {
        return collect($data)
            ->map(fn ($content, $variable) => implode('=', [$variable, $content]))
            ->implode(PHP_EOL);
    }

    public static function toArray(string $data): array
    {
        return collect(explode(PHP_EOL, $data))
            ->filter()
            ->whenNotEmpty(function ($collection) {
                return $collection->flatMap(function ($env) {
                    [$variable, $content] = explode('=', $env);

                    return [$variable => $content];
                });
            })
            ->toArray();
    }
}
