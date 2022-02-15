<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends MediaModel
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    protected $casts = [
        'id' => 'integer',
    ];

    protected $with = [
        'targets',
    ];

    protected $guarded = ['id'];

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('browsershot')
            ->useFallbackUrl(asset('/images/profile/code.svg'))
            ->useFallbackPath(public_path('/images/profile/code.svg'))
            ->withResponsiveImages()
            ->singleFile();
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }
}
