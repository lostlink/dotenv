<?php

namespace App\Http\Livewire\Target;

use App\Models\Project;
use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Create extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $url = null;

    public ?string $notes = null;

    public ?string $variables = null;

    public Project|string $project;

    public function rules(): array
    {
        return [
            'name' => Rule::unique(Target::class)
                ->where(fn ($query) => $query->where('project_id', $this->project->id)),
            'notes' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function submit(): \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $this->authorize('create', [Target::class, Project::class]);

        $target = $this->project->targets()
            ->create(
                $this->validate()
            );

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->project)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties(
                $target->toArray()
            )
            ->log('Target Created');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('target.livewire.create-or-update');
    }
}
