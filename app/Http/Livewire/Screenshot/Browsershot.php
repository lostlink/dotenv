<?php

namespace App\Http\Livewire\Screenshot;

use App\Models\BrowsershotModel;
use App\Traits\TakesScreenshots;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Browsershot extends Component
{
    use LivewireAlert;
    use TakesScreenshots;

    public BrowsershotModel $model;
    public string $class;
    public string $imageUrl;
    public string $imageName;

    public function mount(): void
    {
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->model->getAttribute('name');
    }

    public function refresh(): void
    {
        if (is_null($this->model->getAttribute('url'))) {
            $this->alert('warning', 'No URL Defined!');

            return;
        }

        $path = 'browsershot/' . Str::slug($this->model->getAttribute('name')) . '.png';

        Storage::put($path, $this->getImage($this->model->getAttribute('url')));

        $this->model
            ->addMedia(Storage::path($path))
            ->toMediaCollection('browsershot');

        $this->alert('success', 'Update Updated!');

        $this->imageUrl = $this->model->refresh()->getFirstMediaUrl('browsershot');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('screenshot.livewire.browsershot');
    }
}
