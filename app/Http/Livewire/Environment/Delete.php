<?php

namespace App\Http\Livewire\Environment;

use App\Models\Environment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;

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

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('environment.livewire.delete');
    }
}
