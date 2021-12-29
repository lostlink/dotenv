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
        'team_model' => 'array',
        'user_model' => 'array',
        'project_model' => 'array',
        'target_model' => 'array',
        'environment_model' => 'array',
    ];

    public function user(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new User($this->getAttribute('user_model') ?? [])
        );
    }

    public function team(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Team($this->getAttribute('team_model') ?? [])
        );
    }

    public function project(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Project($this->getAttribute('project_model') ?? [])
        );
    }

    public function target(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Target($this->getAttribute('target_model') ?? [])
        );
    }

    public function environment(): Attribute
    {
        return new Attribute(
            get: fn ($value) => new Environment($this->getAttribute('environment_model') ?? [])
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
