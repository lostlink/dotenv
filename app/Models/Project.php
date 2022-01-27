<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends BrowsershotModel
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'id' => 'integer',
    ];

    protected $with = [
        'targets',
    ];

    protected $guarded = [];

    protected static function booted(): void
    {
        static::addGlobalScope('currentTeam', function (Builder $builder) {
            $builder->where('team_id', currentTeam('id'));
        });
    }

    public function routeKey(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->getAttribute('slug'),
            set: fn ($value) => $this->getAttribute('slug'),
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Team::class);
    }

    public function targets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Target::class);
    }
}
