<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Env implements Rule
{
    public function passes($attribute, $value): bool
    {
        return collect(explode(PHP_EOL, $value))
            ->filter()
            ->map(fn ($line) => Str::of($line)->before('#')->trim())
            ->reject(function ($line) {
                return collect(explode('=', $line, 2))->count() === 2;
            })
            ->isEmpty();
    }

    public function message()
    {
        return 'Invalid Environment';
    }
}
