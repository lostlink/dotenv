<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Env implements Rule
{
    public function passes($attribute, $value): bool
    {
        return collect(explode(PHP_EOL, $value))
            ->map(fn ($line) => (string) Str::of($line)->before('#')->trim())
            ->filter()
            ->reject(function ($line) {
                return collect(explode('=', $line, 2))->count() === 2;
            })
            ->isEmpty();
    }

    public function message(): string
    {
        return 'Invalid Environment';
    }
}
