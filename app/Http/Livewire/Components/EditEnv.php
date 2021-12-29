<?php

namespace App\Http\Livewire\Components;

use App\Helpers\EnvParser;
use App\Jobs\RecordActivity;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditEnv extends Component
{
    use LivewireAlert;

    public string $title;
    public Project|Target|Environment $model;
    public string $variables;
    public ?Project $project = null;
    public ?Target $target = null;
    public ?Environment $environment = null;

    public function mount()
    {
        $this->variables = EnvParser::toEnv($this->model->variables);
    }

    public function save()
    {
        $this->model->variables = EnvParser::toArray($this->variables);

        $originalVariables = EnvParser::toEnv(collect($this->model->getOriginal('variables'))->sort()->toArray());
        $updatedVariables = EnvParser::toEnv(collect(EnvParser::toArray($this->variables))->sort()->toArray());

        if ($this->shouldNotSave($originalVariables, $updatedVariables)) {
            $this->alert('warning', 'Nothing to Update!');
            return;
        }

        if ($this->model->save()) {
            $this->alert('success', 'ENV Successfully Updated!');
            RecordActivity::dispatch(
                request()->user()->currentTeam,
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
            request()->user()->currentTeam,
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
        return view('livewire.components.edit-env');
    }

    private function shouldNotSave($originalVariables, $updatedVariables): bool
    {
        return trim($originalVariables) === trim($updatedVariables);
    }
}
