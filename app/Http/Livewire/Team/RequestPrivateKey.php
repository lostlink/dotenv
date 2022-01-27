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

    public function rules(): array
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

    public function generateKey($type = 'cipher'): void
    {
        $this->privateKey = Crypt::generateKey($type);
    }

    public function submit(): void
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

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('teams.request-private-key');
    }
}
