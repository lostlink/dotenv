<?php

namespace App\Http\Livewire\Target;

use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Edit extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $notes = null;

    public ?string $variables = null;

    public Target|string $target;

    public function rules()
    {
        return [
            'name' => Rule::unique(Target::class)
                ->where(fn ($query) => $query->where('project_id', $this->target->project_id)),
            'notes' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function mount(Target $target)
    {
        $this->target = $target;
        $this->name = $this->target->name;
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
        return view('target.livewire.create-or-edit');
    }
}
