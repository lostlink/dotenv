<?php

namespace App\Http\Livewire\Traits;

use App\Actions\Browsershot;
use Hammerstone\Sidecar\Exceptions\LambdaExecutionException;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

trait Screenshot
{
    use WithMedia;
    use LivewireAlert;

    public array $mediaComponentNames = ['screenshot'];
    public string|array|null $screenshot;

    public function screenshotFromUpload($model): void
    {
        $this->validate([
            'screenshot' => 'required',
        ]);

        $model
            ->addFromMediaLibraryRequest($this->screenshot)
            ->toMediaCollection('browsershot');

        $this->clearMedia();
    }

    public function screenshotFromUrl(): void
    {
        $this->model
            ->addMediaFromBase64($this->screenshot)
            ->usingFileName(Str::slug($this->model->getAttribute('name')) . '.png')
            ->toMediaCollection('browsershot');
    }

    public function updateUrlScreenshot(): void
    {
        $this->validate([
            'url' => 'url',
        ]);

        try {
            $this->screenshot = trim((new Browsershot())->getBase64($this->url));
            $this->imageUrl = ' data:image/png;base64,' . $this->screenshot;
        } catch (LambdaExecutionException $e) {
            $this->alert('error', 'Error grabbing the URL Screenshot!');
        }
    }
}
