<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Edit extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $description = null;

    public ?string $variables = null;

    public Project|string $project;

    public function rules()
    {
        return [
            'name' => Rule::unique(Project::class)
                ->where(fn ($query) => $query->where('team_id', currentTeam('id'))),
            'description' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->name = $this->project->name;
        $this->description = $this->project->description;
        $this->variables = $this->project->variables;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', [Project::class]);

        $this->project->update(
            $this->validate()
        );

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->project)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
            })
            ->withProperties([
                'update' => $this->project->getOriginal(),
                'original' => $this->project->getDirty(),
            ])
            ->log('Project Updated');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('project.livewire.create-or-edit');
    }
}
