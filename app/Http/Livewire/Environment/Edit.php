<?php

namespace App\Http\Livewire\Environment;

use App\Jobs\RecordActivity;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use App\Rules\Env;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public string $title;
    public Project|Target|Environment $model;
    public ?string $variables = null;
    public ?Project $project = null;
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
            RecordActivity::dispatch(
                currentTeam(),
                request()->user(),
                $this->project,
                $this->target,
                $this->environment,
                'WEB Update - ENV',
                'success',
                'Environment Variables Successfully Updated',
                $updatedVariables,
                $originalVariables
            );

            return;
        }

        $this->alert('error', 'Failed to update ENV, please try again after a few minutes');
        RecordActivity::dispatch(
            currentTeam(),
            request()->user(),
            $this->project,
            $this->target,
            $this->environment,
            'WEB Update - ENV',
            'fail',
            'Environment Variables Failed to Update',
            $updatedVariables,
            $originalVariables
        );
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('environment.livewire.edit');
    }

    private function shouldNotSave($originalVariables, $updatedVariables): bool
    {
        return trim($originalVariables) === trim($updatedVariables);
    }
}
