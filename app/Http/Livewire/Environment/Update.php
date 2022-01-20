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

    public function rules()
    {
        return [
            'name' => Rule::unique(Environment::class)
                ->where(fn ($query) => $query->where('target_id', $this->environment->target_id)),
            'url' => 'nullable|url',
            'notes' => 'nullable',
        ];
    }

    public function mount(Environment $environment)
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

    public function render()
    {
        return view('environment.livewire.create-or-edit');
    }
}
