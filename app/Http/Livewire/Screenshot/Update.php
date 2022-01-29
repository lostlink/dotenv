<?php

namespace App\Http\Livewire\Screenshot;

use App\Models\BrowsershotModel;
use App\Traits\TakesScreenshots;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LivewireUI\Modal\ModalComponent;
use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

class Update extends ModalComponent
{
    use WithMedia;
    use LivewireAlert;
    use TakesScreenshots;

    public BrowsershotModel|array $model;
    public string $class;
    public string $imageUrl;
    public string $imageName;
    public array $mediaComponentNames = ['screenshot'];
    public $screenshot;

    public function mount(string $class, array $model): void
    {
        $this->model = new $class($model);
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->model->getAttribute('name');
    }

    public function upload()
    {
        $this->validate([
            'screenshot' => 'required',
        ]);

        $this->model
            ->addFromMediaLibraryRequest($this->screenshot)
            ->toMediaCollection('browsershot');

        $this->alert('success', 'Screenshot Updated!');

        $this->imageUrl = $this->model->refresh()->getFirstMediaUrl('browsershot');

        $this->clearMedia();
    }

    public function browsershot(): void
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

        $this->alert('success', 'Screenshot Updated!');

        $this->imageUrl = $this->model->refresh()->getFirstMediaUrl('browsershot');
    }

    public function render()
    {
        return view('screenshot.livewire.update');
    }
}
