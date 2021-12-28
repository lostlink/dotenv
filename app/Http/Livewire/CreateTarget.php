<?php

namespace App\Http\Livewire;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;

class CreateTarget extends ModalComponent
{
    public ?string $name = null;

    public ?string $notes = null;

    public ?string $variables = null;

    public Project|string $project;

    protected array $rules = [
        'name' => 'required|max:100',
        'notes' => 'nullable|max:100',
        'variables' => 'nullable|max:100',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function submit()
    {
        $this->project->targets()
            ->create(
                $this->validate()
            );

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.create-target');
    }
}
