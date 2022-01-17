<?php

namespace App\Http\Livewire;

use App\Models\BrowsershotModel;
use Illuminate\Support\Str;
use Livewire\Component;

class Browsershot extends Component
{
    9
    public BrowsershotModel $model;
    public string $class;
    public string $imageUrl;
    public string $imageName;

    public function mount()
    {
        $this->imageUrl = $this->model->getFirstMediaUrl('browsershot');
        $this->imageName = $this->model->getAttribute('name');
    }

    public function render()
    {
        return view('livewire.browsershot');
    }

    public function refresh()
    {
        if (is_null($this->model->getAttribute('url'))) {
            return;
        }

        \Spatie\Browsershot\Browsershot::url($this->model->getAttribute('url'))
            ->setNodeModulePath(config('_app.paths.node_modules'))
            ->setNpmBinary(config('_app.binaries.npm'))
            ->setNodeBinary(config('_app.binaries.node'))
            ->setBinPath(app_path('Services/Browsershot/browser.js'))
            ->save(Str::slug($this->model->getAttribute('name')) . '.png');

        $this->model
            ->addMedia(public_path(Str::slug($this->model->getAttribute('name')) . '.png'))
            ->toMediaCollection('browsershot');

        $this->imageUrl = $this->model->refresh()->getFirstMediaUrl('browsershot');
    }
}
