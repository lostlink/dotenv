<?php

namespace App\Http\Livewire\Environment;

use App\Models\Environment;
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

    public Target|string $target;

    public function rules(): array
    {
        return [
            'name' => Rule::unique(Environment::class)
                ->where(fn ($query) => $query->where('target_id', $this->target->id)),
            'url' => 'nullable|url',
            'notes' => 'nullable',
        ];
    }

    public function mount(Target $target): void
    {
        $this->target = $target;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('create', [Environment::class, Target::class, Project::class]);

        $environment = $this->target->environments()
            ->create(
                $this->validate()
            );

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->target)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties(
                $environment->toArray()
            )
            ->log('Target Environment Created');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('environment.livewire.create-or-update');
    }
}
