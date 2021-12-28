<?php

namespace App\Http\Livewire;

use App\Models\Target;
use LivewireUI\Modal\ModalComponent;

class CreateEnvironment extends ModalComponent
{
    public ?string $name = null;

    public ?string $url = null;

    public ?string $notes = null;

    public ?string $variables = null;

    public Target|string $target;

    protected array $rules = [
        'name' => 'required|max:100',
        'url' => 'nullable|url',
        'notes' => 'nullable|max:100',
        'variables' => 'nullable|max:100',
    ];

    public function mount(Target $target)
    {
        $this->target = $target;
    }

    public function submit()
    {
        $this->target->environments()
            ->create(
                $this->validate()
            );

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.create-environment');
    }
}
