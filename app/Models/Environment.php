<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Environment extends BrowsershotModel
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'id' => 'integer',
    ];

    protected $guarded = [];

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

    public function target(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Target::class);
    }
}
