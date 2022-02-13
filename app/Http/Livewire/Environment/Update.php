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

    public Environment|string $environment;
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
                $this->name === $this->environment->getOriginal('name')
                    ? null
                    : Rule::unique(Environment::class)->where(fn ($query) => $query->where('target_id', $this->environment->target_id)),
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
        $this->environment = $environment;
        $this->name = $environment->name;
        $this->url = $environment->url;
        $this->notes = $environment->notes;
        $this->imageUrl = $this->environment->getFirstMediaUrl('browsershot');
        $this->imageName = $this->name;
    }

    public function submit(): Redirector|Application|RedirectResponse
    {
        $this->authorize('update', [Environment::class, $this->environment]);

        $this->environment
            ->update(
                $this->validate()
            );

        if ($this->screenshot) {
            $this->screenshotFromUpload($this->environment);
        }

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->environment)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties([
                'update' => $this->environment->getOriginal(),
                'original' => $this->environment->getDirty(),
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
