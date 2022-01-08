<?php

namespace App\Http\Livewire\Environment;

use App\Models\Environment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Delete extends ModalComponent
{
    use AuthorizesRequests;

    public Environment|string $environment;

    public function mount(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function delete()
    {
        $this->authorize('delete', [Environment::class, $this->environment]);

        $this->environment->delete();

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->environment->target)
            ->tap(function (Activity $activity) {
                $activity->team_id = currentTeam('id');
            })
            ->withProperties(
                $this->environment->getOriginal()
            )
            ->log('Target Environment Deleted');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('environment.livewire.delete');
    }
}
