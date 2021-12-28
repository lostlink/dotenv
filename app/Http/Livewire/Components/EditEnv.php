<?php

namespace App\Http\Livewire\Components;

use App\Helpers\EnvParser;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditEnv extends Component
{
    use LivewireAlert;

    public string $title;
    public $model;
    public $variables;

    public $project;
    public $target;
    public $environment;

    public function mount()
    {
        $this->variables = EnvParser::toEnv($this->model->variables);
    }

    public function save()
    {
        $this->model->variables = EnvParser::toArray($this->variables);
        $this->model->save();
        $this->alert('success', 'ENV Successfully Updated!');
    }

    public function render()
    {
        return view('livewire.components.edit-env');
    }
}
