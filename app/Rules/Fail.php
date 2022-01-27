<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Fail implements Rule
{
    public function passes($attribute, $value): bool
    {
        return false;
    }

    public function message(): string
    {
        return 'Invalid Value';
    }
}
