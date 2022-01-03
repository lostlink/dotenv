<?php

namespace App\Http\Livewire\Environment;

use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
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
            'name' => Rule::unique(Environment::class)
                ->where(fn ($query) => $query->where('target_id', $this->target->id)),
            'url' => 'nullable|url',
            'notes' => 'nullable|max:100',
            'variables' => 'nullable|max:100',
        ];
    }

    public function mount(Target $target)
    {
        $this->target = $target;
    }

    public function submit()
    {
        $this->authorize('create', [Environment::class, Target::class, Project::class]);

        $this->target->environments()
            ->create(
                $this->validate()
            );

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('environment.livewire.create');
    }
}
