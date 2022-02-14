<?php

namespace App\Http\Livewire\Traits;

use App\Actions\Browsershot;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

trait Screenshot
{
    use WithMedia;
    use LivewireAlert;

    public array $mediaComponentNames = ['screenshot'];
    public $screenshot;

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
        $this->validate([
            'url' => 'url',
        ]);

        $browsershotImage = (new Browsershot())->getBase64($this->url);

        $this->model
            ->addMediaFromBase64(trim($browsershotImage))
            ->usingFileName(Str::slug($this->model->getAttribute('name')) . '.png')
            ->toMediaCollection('browsershot');

        $this->alert('success', 'Screenshot Updated!');

        $this->imageUrl = $this->model->refresh()->getFirstMediaUrl('browsershot');
    }
}
