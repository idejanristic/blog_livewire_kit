<?php

namespace App\Repositories\Filters\Posts;

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
                $searchTerm = "%{$this->search}%";
                $query->where(
                    column: function (Builder $query) use ($searchTerm): void {
                        $query->where(
                            column: 'title',
                            operator: 'like',
                            value: $searchTerm
                        )
                            ->orWhere(
                                column: 'excerpt',
                                operator: 'like',
                                value: $searchTerm
                            )
                            ->orWhere(
                                column: 'body',
                                operator: 'like',
                                value: $searchTerm
                            );
                    }
                );
            }
        );
    }
}
