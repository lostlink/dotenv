<?php

namespace App\Http\Livewire\Target;

use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Delete extends ModalComponent
{
    use AuthorizesRequests;

    public int $environmentId;
    public Target|string $target;

    public function mount(Target $target)
    {
        $this->target = $target;
    }

    public function delete()
    {
        $this->authorize('delete', [Target::class, $this->target]);

        $this->target->delete();

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->target)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->log('Target Deleted');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('target.livewire.delete');
    }
}
