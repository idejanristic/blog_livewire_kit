<?php

namespace App\Repositories;

use App\Dtos\SortDto;
use App\Dtos\Users\UserFilterDto;
use App\Models\User;
use App\Repositories\Filters\Users\SearchFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @return int
     */
    public static function total(): int
    {
        return User::count();
    }

    /**
     * @param \App\Dtos\Users\UserFilterDto $filters
     * @param \App\Dtos\SortDto $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<User>
     */
    private static function getUserQuery(UserFilterDto $filters, SortDto $sortDto)
    {
        return User::query()
            ->with(relations: [
                'roles',
                'profile'
            ])
            ->tap(
                callback: new SearchFilter(
                    search: $filters->search
                )
            )
            ->orderBy(
                column: $sortDto->sortBy,
                direction: $sortDto->sortDir
            );
    }

    /**
     * @param int $perPage
     * @param \App\Dtos\Users\UserFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getUsers(
        int $perPage,
        UserFilterDto $filters,
        ?SortDto $sortDto = null
    ): LengthAwarePaginator {

        if ($filters === null) {
            $filters = new UserFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new $sortDto();
        }

        return self::getUserQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(perPage: $perPage);
    }
}
