<?php

namespace App\Http\Livewire\Screenshot;

use App\Models\BrowsershotModel;
use App\Traits\TakesScreenshots;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Show extends Component
{
    public BrowsershotModel|string $model;
    public string $class;
    public string $imageUrl;
    public string $imageName;

    public function mount(BrowsershotModel $model): void
    {
        $this->model = $model;
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->model->getAttribute('name');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('screenshot.livewire.show');
    }
}
