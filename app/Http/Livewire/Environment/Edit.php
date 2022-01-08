<?php

namespace App\Http\Livewire\Environment;

use App\Helpers\Crypt;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use App\Rules\Env;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Edit extends Component
{
    use LivewireAlert;

    public string $title;
    public Project|Target|Environment $model;
    public ?string $variables = null;
    public Project $project;
    public ?Target $target = null;
    public ?Environment $environment = null;

    public function mount()
    {
        $this->variables = $this->model->variables;
        $this->validateOnly('variables', ['variables' => new Env()]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['variables' => new Env()]);
    }

    public function encrypt()
    {
        if (is_null($this->variables)) {
            $this->alert('warning', 'Nothing to Encrypt!');

            return;
        }

        $privateKey = $this->getPrivateKeyFromSession();

        if (is_null($privateKey)) {
            $this->alert('error', 'Missing PrivateKey!');

            return;
        }

        $encryptedVariables = Crypt::encrypt($this->variables, $privateKey);

        if (is_null($encryptedVariables)) {
            $this->alert('warning', 'Already Encrypted!');

            return;
        }

        $this->variables = $encryptedVariables;
        $this->alert('success', 'Successfully Encrypted!');
    }

    public function decrypt()
    {
        if (is_null($this->variables)) {
            $this->alert('warning', 'Nothing to Decrypt!');

            return;
        }

        $privateKey = $this->getPrivateKeyFromSession();

        if (is_null($privateKey)) {
            $this->alert('error', 'Missing PrivateKey!');

            return;
        }

        try {
            $decryptedVariables = Crypt::decrypt($this->variables, $privateKey);
        } catch (\Exception $e) {
            $this->alert('error', 'Unable to decrypt, please verify PrivateKey!');

            return;
        }

        if (is_null($decryptedVariables)) {
            $this->alert('warning', 'Already Decrypted!');

            return;
        }

        $this->variables = $decryptedVariables;
        $this->alert('success', 'Successfully Decrypted!');
    }

    public function save()
    {
        $this->model->variables = $this->variables;

        $originalVariables = $this->model->getOriginal('variables');
        $updatedVariables = $this->variables;

        if ($this->shouldNotSave($originalVariables, $updatedVariables)) {
            $this->alert('warning', 'Nothing to Update!');

            return;
        }

        if ($this->model->save()) {
            $this->alert('success', 'ENV Successfully Updated!');
            activity()
                ->causedBy(request()->user())
                ->performedOn($this->model)
                ->tap(function (Activity $activity) {
                    $activity->setAttribute('team_id', currentTeam('id'));
                })
                ->withProperties([
                    'updatedVariables' => $updatedVariables,
                    'originalVariables' => $originalVariables,
                ])
                ->log('Environment Variables Updated');

            return;
        }

        $this->alert('error', 'Failed to update ENV, please try again after a few minutes');
        activity()
            ->causedBy(request()->user())
            ->performedOn($this->model)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
            })
            ->withProperties([
                'updatedVariables' => $updatedVariables,
                'originalVariables' => $originalVariables,
            ])
            ->log('Environment Variables Update Failed');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('environment.livewire.edit');
    }

    private function shouldNotSave($originalVariables, $updatedVariables): bool
    {
        return trim($originalVariables) === trim($updatedVariables);
    }

    private function getPrivateKeyFromSession()
    {
        if (! session()->exists(currentTeam('id') . '_private_key')) {
            $this->emit('openModal', 'team.request-private-key');

            return null;
        }

        return session(currentTeam('id') . '_private_key');
    }

    public function clearPrivateKeyFromSession()
    {
        session()->forget(currentTeam('id') . '_private_key');
        $this->alert('success', 'PrivateKey Cleared from the Session!');
    }
}
