<?php

namespace  App\Repositories\Filters\Activities;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{

    public function __construct(
        private string $search = ''
    ) {}


    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->search !== '',
            callback: function (Builder $query): void {
                $query->where(
                    column: 'type',
                    operator: 'like',
                    value: "%{$this->search}%"
                );
            }
        );
    }
}
