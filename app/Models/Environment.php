<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Environment extends MediaModel
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    protected $casts = [
        'id' => 'integer',
    ];

    protected $guarded = ['id'];

    public function routeKey(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->getAttribute('slug'),
            set: fn ($value) => $this->getAttribute('slug'),
        );
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return $this
            ->where('id', $value)
            ->whereOr('slug', $value)
            ->firstOrFail();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->allowDuplicateSlugs()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('browsershot')
            ->useFallbackUrl(asset('/images/profile/code.svg'))
            ->useFallbackPath(public_path('/images/profile/code.svg'))
            ->withResponsiveImages()
            ->singleFile();
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(Target::class);
    }
}
