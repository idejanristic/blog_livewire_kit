<?php

namespace App\Repositories\Filters\Tags;

use Illuminate\Database\Eloquent\Builder;

class TagFilter
{
    public function __construct(
        private int $tagId = 0
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->tagId !== 0,
            callback: fn(Builder $query): Builder => $query->whereHas(
                relation: 'tags',
                callback: fn(Builder $tagQuery): Builder => $tagQuery->where(column: 'tags.id', operator: $this->tagId)
            )
        );
    }
}
