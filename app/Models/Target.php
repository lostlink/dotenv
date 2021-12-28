<?php

namespace App\Models;

use App\Events\TargetCreatedEvent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Target extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'id' => 'integer',
        'variables' => 'array',
    ];

    protected $with = [
        'environments',
    ];

    protected $fillable = [
        'name',
        'description',
        'variables',
    ];

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

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

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    public function environments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Environment::class);
    }
}
