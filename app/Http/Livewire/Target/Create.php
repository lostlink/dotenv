<?php

namespace App\Http\Livewire\Target;

use App\Http\Livewire\Traits\Screenshot;
use App\Models\Project;
use App\Models\Target;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Create extends ModalComponent
{
    use AuthorizesRequests;
    use Screenshot;

    public Target $model;
    public Project|string $project;
    public ?string $name = null;
    public ?string $url = null;
    public ?string $notes = null;
    public ?string $variables = null;
    public ?string $imageUrl;
    public ?string $imageName;

    public function rules(): array
    {
        return [
            'name' => Rule::unique(Target::class)
                ->where(fn($query) => $query->where('project_id', $this->project->id)),
            'notes' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(Project $project): void
    {
        $this->project = $project;
        $this->imageUrl = asset('images/profile/code.svg');
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->authorize('create', [Target::class, Project::class]);

        $this->model = $this->project->targets()
            ->create(
                $this->validate()
            );

        if ($this->screenshot) {
            match (is_array($this->screenshot)) {
                true => $this->screenshotFromUpload($this->model),
                default => $this->screenshotFromUrl()
            };
        }

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->project)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties(
                $this->model->toArray()
            )
            ->log('Target Created');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): Factory|View
    {
        return view('target.livewire.create-or-update');
    }
}
