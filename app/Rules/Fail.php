<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Fail implements Rule
{
    public function passes($attribute, $value)
    {
        return false;
    }

    public function message()
    {
        return 'Invalid Value';
    }
}
