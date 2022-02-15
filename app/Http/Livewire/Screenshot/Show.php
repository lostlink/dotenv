<?php

namespace App\Http\Livewire\Screenshot;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Show extends Component
{
    public Model|string $model;
    public string $class;
    public string $imageUrl;
    public string $imageName;

    public function mount(Model $model): void
    {
        $this->model = $model;
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->model->getAttribute('name');
    }

    public function render(): Factory|View
    {
        return view('screenshot.livewire.show');
    }
}
