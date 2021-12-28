<?php

namespace App\JsonApi\V20220101\Targets;

use App\Models\Target;
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

class TargetSchema extends Schema
{
    public static string $model = Target::class;

    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('project_id')->type('projects')->readOnly(),
            HasMany::make('environments')->readOnly(),
            Str::make('slug'),
            Str::make('name')->sortable(),
            ArrayHash::make('variables'),
            Str::make('notes'),
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
