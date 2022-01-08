<?php

namespace App\Http\Livewire\Team;

use App\Helpers\Crypt;
use App\Rules\CipherKey;
use App\Rules\Fail;
use App\Rules\OpenSslKey;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class RequestPrivateKey extends ModalComponent
{
    public ?string $privateKey = '';

    public function rules()
    {
        return match (Crypt::guessCryptFromPrivateKey($this->privateKey)) {
            'cipher' => [
                'privateKey' => ['required', new CipherKey()],
            ],
            'openssl' => [
                'privateKey' => ['required', new OpenSslKey()],
            ],
            default => [
                'privateKey' => ['required', new Fail()],
            ]
        };
    }

    public function submit()
    {
        $this->validate();

        session([
            currentTeam('id') . '_private_key' => match (Crypt::guessCryptFromPrivateKey($this->privateKey)) {
                'cipher' => $this->privateKey,
                'openssl' => collect([
                    '-----BEGIN PRIVATE KEY-----',
                    Str::between($this->privateKey, '-----BEGIN PRIVATE KEY-----', '-----END PRIVATE KEY-----'),
                    '-----END PRIVATE KEY-----',
                ])->filter()->implode(''),
                default => null
            },
        ]);

        $this->closeModal();
    }

    public function render()
    {
        return view('teams.request-private-key');
    }
}
