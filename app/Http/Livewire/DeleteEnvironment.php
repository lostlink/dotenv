<?php

namespace App\Http\Livewire;

use App\Models\Environment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;

class DeleteEnvironment extends ModalComponent
{
    use AuthorizesRequests;

    public int $environmentId;
    public Environment $environment;

    public function mount(int $environmentId)
    {
        $this->environmentId = $environmentId;
        $this->environment = Environment::findOrFail($environmentId);
    }

    public function delete()
    {
        // TODO: Implement authorization proper
//        $this->authorize('delete', [request()->user(), Environment::class]);

        $this->environment->delete();

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.delete-environment');
    }
}
