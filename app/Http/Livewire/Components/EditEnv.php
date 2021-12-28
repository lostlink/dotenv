<?php

namespace App\Http\Livewire\Components;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditEnv extends Component
{
    use LivewireAlert;

    public string $title;
    public $model;
    public $variables;

    public function mount()
    {
        $this->variables = $this->arrayToEnv($this->model->variables);
    }

    public function save()
    {
        $this->model->variables = $this->envToArray($this->variables);
        $this->model->save();
        $this->alert('success', 'ENV Successfully Updated!');
//        $this->variables = $this->arrayToEnv($this->model->variables);
    }

    public function render()
    {
        return view('livewire.components.edit-env');
    }

    private function arrayToEnv(?array $data)
    {
        return collect($data)
            ->map(fn ($content, $variable) => implode('=', [$variable, $content]))
            ->implode(PHP_EOL);
    }

    private function envToArray(string $data)
    {
        return collect(explode(PHP_EOL, $data))
            ->filter()
            ->whenNotEmpty(function ($collection) {
                return $collection->flatMap(function ($env) {
                    [$variable, $content] = explode('=', $env);
                    return [$variable => $content];
                });
            })
            ->toArray();
    }
}
