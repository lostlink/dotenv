<?php

namespace App\Http\Livewire\Environment;

use App\Http\Livewire\Traits\Screenshot;
use App\Models\Environment;
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

    public Environment|string $model;
    public ?string $name = null;
    public ?string $url = null;
    public ?string $notes = null;
    public string $imageUrl;
    public string $imageName;

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                $this->name === $this->model->getOriginal('name')
                    ? null
                    : Rule::unique(Environment::class)->where(fn($query) => $query->where('target_id', $this->model->target_id)),
            ],
            'url' => [
                'url',
                'nullable',
            ],
            'notes' => [
                'nullable',
            ],
        ];
    }

    public function mount(Environment $environment): void
    {
        $this->model = $environment;
        $this->name = $environment->name;
        $this->url = $environment->url;
        $this->notes = $environment->notes;
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->name;
    }

    public function save(): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', [Environment::class, $this->model]);

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
            ->log('Environment Updated');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): Factory|View
    {
        return view('environment.livewire.create-or-update');
    }
}
