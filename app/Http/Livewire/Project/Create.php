<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $description = null;

    public ?string $variables = null;

    public function rules()
    {
        return [
            'name' => Rule::unique(Project::class)
                ->where(fn ($query) => $query->where('team_id', currentTeam('id'))),
            'description' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function submit()
    {
        $this->authorize('create', [Project::class]);

        currentTeam()->projects()->create(
            $this->validate()
        );

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('project.livewire.create-or-edit');
    }
}
