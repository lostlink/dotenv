<?php

namespace App\Http\Livewire\Target;

use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;

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

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('target.livewire.delete');
    }
}
