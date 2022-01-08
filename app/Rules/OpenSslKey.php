<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class OpenSslKey implements Rule
{
    public function passes($attribute, $value)
    {
        if (Str::containsAll($value, ['-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----'])) {
            return $this->checkKey($value, 'PUBLIC');
        }

        if (Str::containsAll($value, ['-----BEGIN PRIVATE KEY-----', '-----END PRIVATE KEY-----'])) {
            return $this->checkKey($value, 'PRIVATE');
        }

        return false;
    }

    public function message()
    {
        return 'Invalid OpenSSL Key provided';
    }

    private function checkKey($value, $type)
    {
        return collect(explode(PHP_EOL, Str::between($value, "-----BEGIN {$type} KEY-----", "-----END {$type} KEY-----")))
            ->filter()
            ->pipe(fn ($collection) => Str::length($collection->pop()) === 32 ? $collection : collect())
            ->map(function ($line) {
                return match (Str::length($line)) {
                    64 => $line,
                    default => null,
                };
            })
            ->filter()
            ->pipe(fn ($collection) => in_array($collection->count(), [11, 49]));
    }
}
