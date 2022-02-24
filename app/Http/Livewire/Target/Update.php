<?php

namespace App\Http\Livewire\Target;

use App\Http\Livewire\Traits\Screenshot;
use App\Models\Target;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Update extends ModalComponent
{
    use AuthorizesRequests;
    use LivewireAlert;
    use Screenshot;

    public Target|string $model;
    public ?string $name = null;
    public ?string $url = null;
    public ?string $notes = null;
    public ?string $variables = null;
    public string $imageUrl;
    public string $imageName;

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                $this->name === $this->model->getOriginal('name')
                    ? null
                    : Rule::unique(Target::class)->where(fn ($query) => $query->where('project_id', $this->model->project_id)),
            ],
            'url' => [
                'url',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'variables' => [
                'string',
                'nullable',
            ],
        ];
    }

    public function mount(Target $target): void
    {
        $this->model = $target;
        $this->name = $this->model->name;
        $this->url = $this->model->url;
        $this->notes = $this->model->notes;
        $this->variables = $this->model->variables;
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->name;
    }

    public function save(): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', [Target::class, $this->model]);

        $this->model
            ->update(
                $this->validate()
            );

        if (! empty($this->screenshot)) {
            match (is_array($this->screenshot)) {
                true => $this->screenshotFromUpload($this->model),
                default => $this->screenshotFromUrl()
            };
        }

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->model)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties([
                'update' => $this->model->getOriginal(),
                'original' => $this->model->getDirty(),
            ])
            ->log('Target Updated');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): Factory|View
    {
        return view('target.livewire.create-or-update');
    }
}
