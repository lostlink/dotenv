<?php

namespace App\Helpers;

use Spatie\Crypto\Rsa\KeyPair;
use Spatie\Crypto\Rsa\PrivateKey;
use Spatie\Crypto\Rsa\PublicKey;

class CryptOpenSsl
{
    public string $value;

    private PrivateKey|string $privateKey;

    private PublicKey|string $publicKey;

    public function __construct(string $value, string $privateKey)
    {
        $this->privateKey = PrivateKey::fromString($privateKey);
        $this->publicKey = PublicKey::fromString($this->privateKey->details()['key']);
        $this->value = $value;
    }

    public static function generateKey(): string
    {
        return collect((new KeyPair())->generate())->first();
    }

    public function encrypt(): ?string
    {
        if (ctype_xdigit($this->value)) {
            return null;
        }

        return bin2hex($this->publicKey->encrypt($this->value));
    }

    public function decrypt(): ?string
    {
        if (! ctype_xdigit($this->value)) {
            return null;
        }

        return $this->privateKey->decrypt(hex2bin($this->value));
    }
}
