<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'team' => 'array',
        'user' => 'array',
        'project' => 'array',
        'target' => 'array',
        'environment' => 'array',
    ];

    public function user(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new User($this->user ?? [])
        );
    }

    public function team(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Team($this->team ?? [])
        );
    }

    public function project(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Project($this->project ?? [])
        );
    }

    public function target(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Target($this->target ?? [])
        );
    }

    public function environment(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Environment($this->environment ?? [])
        );
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\User::class);
    }

    public function teams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Team::class);
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Project::class);
    }

    public function targets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Target::class);
    }

    public function environments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Environment::class);
    }
}
