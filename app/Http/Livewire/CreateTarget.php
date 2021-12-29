<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateTarget extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $notes = null;

    public ?string $variables = null;

    public Project|string $project;

    public function rules()
    {
        return [
            'name' => Rule::unique(Target::class)
                ->where(fn ($query) => $query->where('project_id', $this->project->id)),
            'notes' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function submit()
    {
        $this->authorize('create', [Target::class, Project::class]);

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
