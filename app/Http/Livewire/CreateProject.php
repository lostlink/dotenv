<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class CreateProject extends ModalComponent
{
    use AuthorizesRequests;

    public ?string $name = null;

    public ?string $description = null;

    public ?string $variables = null;

    public function rules()
    {
        return [
            'name' => Rule::unique(Project::class)
                ->where(fn ($query) => $query->where('team_id', request()->user()->currentTeam->id)),
            'description' => 'nullable',
            'variables' => 'nullable',
        ];
    }

    public function submit()
    {
        $this->authorize('create', [Project::class]);

        request()->user()->currentTeam->projects()->create(
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
