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

    public ?string $variables = null;

    public Target|string $target;

    public function rules()
    {
        return [
            'name' => Rule::unique(Environment::class)
                ->where(fn ($query) => $query->where('target_id', $this->target->id)),
            'url' => 'nullable|url',
            'notes' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(Target $target)
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
                $activity->team_id = currentTeam('id');
            })
            ->withProperties(
                $environment->toArray()
            )
            ->log('Target Environment Created');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('environment.livewire.create');
    }
}
