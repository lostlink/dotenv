<?php

namespace App\Http\Livewire\Screenshot;

use App\Models\MediaModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public MediaModel|string $model;
    public string $class;
    public string $imageUrl;
    public string $imageName;

    public function mount(MediaModel $model): void
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
