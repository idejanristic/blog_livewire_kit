<?php

namespace App\Repositories\Filters\Comments;

use Illuminate\Database\Eloquent\Builder;

class PostFilter
{
    public function __construct(
        private int $postId = 0
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->postId > 0,
            callback: function (Builder $query): void {
                $query->where(
                    column: 'post_id',
                    operator: '=',
                    value: $this->postId
                );
            }
        );
    }
}
