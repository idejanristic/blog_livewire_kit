<?php

namespace App\Repositories\Filters\Users;

use Illuminate\Database\Eloquent\Builder;

class AuthorRequestFilter
{
    public function __construct(
        private bool $authorRequest = false
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->authorRequest,
            callback: function (Builder $query): void {
                $query->where(
                    column: 'author_request',
                    operator: '=',
                    value: $this->authorRequest
                );
            }
        );
    }
}
