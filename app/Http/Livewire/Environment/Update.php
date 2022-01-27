<?php

namespace App\Http\Livewire\Environment;

use App\Models\Environment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Update extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $url = null;

    public ?string $notes = null;

    public Environment|string $environment;

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
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', [Environment::class, $this->environment]);

        $this->environment
            ->update(
                $this->validate()
            );

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

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('environment.livewire.create-or-update');
    }
}
