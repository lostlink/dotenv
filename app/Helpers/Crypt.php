<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Crypt
{
    public static function generateKey($type = 'cipher'): string
    {
        return match ($type) {
            'cipher' => CryptCipher::generateKey(),
            'openssl' => CryptOpenSsl::generateKey(),
            default => ''
        };
    }

    public static function encrypt(string $value, ?string $privateKey)
    {
        if (is_null($privateKey)) {
            return $value;
        }

        return match (self::guessCryptFromPrivateKey($privateKey)) {
            'cipher' => (new CryptCipher($value, $privateKey))->encrypt(),
            'openssl' => (new CryptOpenSsl($value, $privateKey))->encrypt(),
            default => $value
        };
    }

    public static function decrypt(string $value, ?string $privateKey)
    {
        if (is_null($privateKey)) {
            return $value;
        }

        return match (self::guessCryptFromPrivateKey($privateKey)) {
            'cipher' => (new CryptCipher($value, $privateKey))->decrypt(),
            'openssl' => (new CryptOpenSsl($value, $privateKey))->decrypt(),
            default => $value
        };
    }

    public static function guessCryptFromPrivateKey(?string $privateKey): ?string
    {
        if (Str::length($privateKey) === 44 && Str::endsWith($privateKey, '=')) {
            return 'cipher';
        }

        if (Str::startsWith($privateKey, ['-----BEGIN PRIVATE KEY-----', '-----BEGIN PUBLIC KEY-----'])) {
            return 'openssl';
        }

        return null;
    }

    public static function clearPrivateKey()
    {
        session()->forget('privateKey');
    }
}
