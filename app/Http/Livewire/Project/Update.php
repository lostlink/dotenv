<?php

namespace App\Http\Livewire\Project;

use App\Http\Livewire\Traits\Screenshot;
use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Update extends ModalComponent
{
    use AuthorizesRequests;
    use Screenshot;

    public Project|string $project;
    public ?string $name = null;
    public ?string $description = null;
    public ?string $url = null;
    public ?string $variables = null;
    public string $imageUrl;
    public string $imageName;

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                $this->name === $this->project->getOriginal('name')
                    ? null
                    : Rule::unique(Project::class)->where(fn ($query) => $query->where('team_id', currentTeam('id'))),
            ],
            'url' => [
                'url',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'variables' => [
                'string',
                'nullable',
            ],
        ];
    }

    public function mount(Project $project): void
    {
        $this->project = $project;
        $this->name = $this->project->name;
        $this->url = $this->project->url;
        $this->description = $this->project->description;
        $this->variables = $this->project->variables;
        $this->imageUrl = $this->project->getFirstMediaUrl('browsershot');
        $this->imageName = $this->name;
    }

    public function submit(): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', [Project::class, $this->project]);

        $this->project->update(
            $this->validate()
        );

        if ($this->screenshot) {
            $this->screenshotFromUpload($this->project);
        }

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->project)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties([
                'update' => $this->project->getOriginal(),
                'original' => $this->project->getDirty(),
            ])
            ->log('Project Updated');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): Factory|View
    {
        return view('project.livewire.create-or-update');
    }
}
