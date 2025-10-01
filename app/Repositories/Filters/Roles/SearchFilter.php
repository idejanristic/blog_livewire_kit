<?php

namespace App\Repositories\Filters\Roles;

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
                            column: 'name',
                            operator: 'like',
                            value: $searchTerm
                        )
                            ->orWhere(
                                column: 'description',
                                operator: 'like',
                                value: $searchTerm
                            );
                    }
                );
            }
        );
    }
}
