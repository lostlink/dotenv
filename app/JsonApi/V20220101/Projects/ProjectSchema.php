<?php

namespace App\JsonApi\V20220101\Projects;

use App\Models\Project;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\ArrayHash;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Relations\HasMany;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class ProjectSchema extends Schema
{
    public static string $model = Project::class;

    protected int $maxDepth = 3;

    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('team')->readOnly(),
            HasMany::make('targets')->readOnly(),
            Str::make('slug'),
            Str::make('name')->sortable(),
            ArrayHash::make('variables'),
            Str::make('description'),
            DateTime::make('createdAt')->sortable()->readOnly(),
            DateTime::make('updatedAt')->sortable()->readOnly(),
        ];
    }

    public function filters(): array
    {
        return [
            WhereIdIn::make($this),
        ];
    }

    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
