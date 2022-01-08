<?php

namespace App\Helpers;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class CryptCipher
{
    public string $value;

    private string $privateKey;

    private Encrypter $encrypter;

    public function __construct(string $value, string $privateKey)
    {
        $this->privateKey = $privateKey;
        $this->encrypter = new Encrypter(base64_decode($this->privateKey), config('app.cipher'));
        $this->value = $value;
    }

    public static function generateKey(): string
    {
        return base64_encode(Crypt::generateKey(config('app.cipher')));
    }

    public function encrypt(): ?string
    {
        if (Str::startsWith($this->value, 'ey')) {
            return null;
        }

        return $this->encrypter->encrypt($this->value);
    }

    public function decrypt(): ?string
    {
        if (! Str::startsWith($this->value, 'ey')) {
            return null;
        }

        return $this->encrypter->decrypt($this->value);
    }
}
