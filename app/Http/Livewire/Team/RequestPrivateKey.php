<?php

namespace App\Http\Livewire\Team;

use App\Rules\OpenSslKey;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class RequestPrivateKey extends ModalComponent
{
    public string $privateKey = '';

    public function rules()
    {
        return [
            'privateKey' => ['required', new OpenSslKey()],
        ];
    }

    public function submit()
    {
        $this->validate();

        session([
            currentTeam('id') . '_private_key' => collect([
                    '-----BEGIN PRIVATE KEY-----',
                    Str::between($this->privateKey, '-----BEGIN PRIVATE KEY-----', '-----END PRIVATE KEY-----'),
                    '-----END PRIVATE KEY-----',
                ])->filter()->implode(''),
        ]);

        $this->closeModal();
    }

    public function render()
    {
        return view('teams.request-private-key');
    }
}
