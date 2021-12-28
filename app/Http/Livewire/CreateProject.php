<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateProject extends ModalComponent
{
    public ?string $name = null;

    public ?string $description = null;

    public ?string $variables = null;

    protected array $rules = [
        'name' => 'required|max:100',
        'description' => 'nullable|max:100',
        'variables' => 'nullable|max:100',
    ];

    public function submit()
    {
        Auth::user()->currentTeam->projects()->create(
            $this->validate()
        );

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.create-project');
    }
}
