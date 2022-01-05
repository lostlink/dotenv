<?php

namespace App\Http\Livewire\Target;

use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

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

    public function submit()
    {
        $this->authorize('update', [Target::class, $this->target]);

        $this->target
            ->update(
                $this->validate()
            );

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('target.livewire.create-or-edit');
    }
}
