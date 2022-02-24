<?php

namespace App\Http\Livewire\Environment;

use App\Http\Livewire\Traits\Screenshot;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Target;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Spatie\Activitylog\Models\Activity;

class Create extends ModalComponent
{
    use AuthorizesRequests;
    use Screenshot;

    public Environment $model;
    public Target|string $target;
    public ?string $name = null;
    public ?string $url = null;
    public ?string $notes = null;
    public ?string $imageUrl;
    public ?string $imageName;

    public function rules(): array
    {
        return [
            'name' => Rule::unique(Environment::class)
                ->where(fn ($query) => $query->where('target_id', $this->target->id)),
            'url' => 'nullable|url',
            'notes' => 'nullable',
        ];
    }

    public function mount(Target $target): void
    {
        $this->target = $target;
        $this->imageUrl = asset('images/profile/code.svg');
    }

    public function save(): Redirector|Application|RedirectResponse
    {
        $this->authorize('create', [Environment::class, Target::class, Project::class]);

        $this->model = $this->target->environments()
            ->create(
                $this->validate()
            );

        if ($this->screenshot) {
            match (is_array($this->screenshot)) {
                true => $this->screenshotFromUpload($this->model),
                default => $this->screenshotFromUrl()
            };
        }

        activity()
            ->causedBy(request()->user())
            ->performedOn($this->target)
            ->tap(function (Activity $activity) {
                $activity->setAttribute('team_id', currentTeam('id'));
                $activity->setAttribute('trigger', 'WEB');
            })
            ->withProperties(
                $this->model->toArray()
            )
            ->log('Target Environment Created');

        $this->closeModal();

        return redirect(request()->header('Referer'));
    }

    public function render(): Factory|View
    {
        return view('environment.livewire.create-or-update');
    }
}
