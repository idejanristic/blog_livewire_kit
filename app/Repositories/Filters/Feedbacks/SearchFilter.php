<?php

namespace App\Repositories\Filters\Feedbacks;

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
                                column: 'email',
                                operator: 'like',
                                value: $searchTerm
                            )
                            ->orWhere(
                                column: 'message',
                                operator: 'like',
                                value: $searchTerm
                            );
                    }
                );
            }
        );
    }
}
