<?php

namespace App\Http\Livewire\Traits;

use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

trait Screenshot
{
    use WithMedia;

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

//        $this->alert('success', 'Screenshot Updated!');
//        $this->imageUrl = $model->refresh()->getFirstMediaUrl('browsershot');

        $this->clearMedia();
    }

//    public function screenshotFromUrl(): void
//    {
//        if (is_null($this->model->getAttribute('url'))) {
//            $this->alert('warning', 'No URL Defined!');
//
//            return;
//        }
//
//        $path = 'browsershot/' . Str::slug($this->model->getAttribute('name')) . '.png';
//
//        Storage::put($path, Browsershot::getImage($this->model->getAttribute('url')));
//
//        $this->model
//            ->addMedia(Storage::path($path))
//            ->toMediaCollection('browsershot');
//
//        $this->alert('success', 'Screenshot Updated!');
//
//        $this->imageUrl = $this->model->refresh()->getFirstMediaUrl('browsershot');
//    }
}
