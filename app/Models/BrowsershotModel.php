<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BrowsershotModel extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('browsershot')
            ->useFallbackUrl(asset('/images/profile/project.webp'))
            ->useFallbackPath(public_path('/images/profile/project.webp'))
            ->withResponsiveImages()
            ->singleFile();
    }
}
