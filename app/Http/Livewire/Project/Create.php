<?php

namespace App\Http\Livewire\Project;

use App\Http\Livewire\Traits\Screenshot;
use App\Models\Project;
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

    public Project $model;
    public ?string $name = null;
    public ?string $url = null;
    public ?string $description = null;
    public ?string $variables = null;
    public ?string $imageUrl;
    public ?string $imageName;

    public function rules(): array
    {
        return [
            'name' => Rule::unique(Project::class)
                ->where(fn($query) => $query->where('team_id', currentTeam('id'))),
            'description' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(): void
    {
        $this->imageUrl = asset('images/profile/code.svg');
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->authorize('create', [Project::class]);

        $this->model = currentTeam()->projects()->create(
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
            ->performedOn(currentTeam())
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties(
                $this->model->toArray()
            )
            ->log('Project Created');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): Factory|View
    {
        return view('project.livewire.create-or-update');
    }
}
