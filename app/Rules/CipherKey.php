<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class CipherKey implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Str::length($value) === 44 && Str::endsWith($value, '=');
    }

    public function message(): string
    {
        return 'Invalid Cipher Key';
    }
}
