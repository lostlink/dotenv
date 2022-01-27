<?php

namespace App\Http\Livewire\Target;

use App\Models\Target;
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

    public ?string $variables = null;

    public Target|string $target;

    public function rules()
    {
        return [
            'name' => [
                'string',
                $this->name === $this->target->getOriginal('name')
                    ? null
                    : Rule::unique(Target::class)->where(fn ($query) => $query->where('project_id', $this->target->project_id)),
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

    public function mount(Target $target)
    {
        $this->target = $target;
        $this->name = $this->target->name;
        $this->url = $this->target->url;
        $this->notes = $this->target->notes;
        $this->variables = $this->target->variables;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', [Target::class, $this->target]);

        $this->target
            ->update(
                $this->validate()
            );

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->target)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties([
                'update' => $this->target->getOriginal(),
                'original' => $this->target->getDirty(),
            ])
            ->log('Target Updated');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('target.livewire.create-or-update');
    }
}
