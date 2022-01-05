<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    use AuthorizesRequests;

    public int $environmentId;
    public Project|string $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function delete()
    {
        $this->authorize('delete', [Project::class, $this->project]);

        $this->project->delete();

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('project.livewire.delete');
    }
}
