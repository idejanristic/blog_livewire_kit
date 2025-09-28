<?php

namespace App\Repositories;

use App\Models\User;
use App\Dtos\PageDto;
use App\Dtos\SortDto;
use App\Dtos\Users\UserFilterDto;
use App\Repositories\Filters\Users\AuthorRequestFilter;
use App\Repositories\Filters\Users\SearchFilter;
use App\Repositories\Filters\Users\TrashedTypeFilter;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @param \App\Models\User $user
     * @return bool|null
     */
    public function delete(User $user): bool|null
    {
        return $user->delete();
    }

    /**
     * @param int $id
     * @return User|null
     */
    public static function find(int $id): User|null
    {
        return self::getUserRelationQuery()
            ->where(column: 'id', operator: $id)
            ->withTrashed()
            ->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<User>
     */
    private static function getUserRelationQuery()
    {
        return User::query()
            ->with(relations: [
                'sessions',
                'roles',
                'profile'
            ]);
    }

    /**
     * @param \App\Dtos\Users\UserFilterDto $filters
     * @param \App\Dtos\SortDto $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<User>
     */
    private static function getUserQuery(?UserFilterDto $filters = null, ?SortDto $sortDto = null)
    {
        if ($filters === null) {
            $filters = new UserFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getUserRelationQuery()
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new TrashedTypeFilter(trashedType: $filters->trashedType))
            ->tap(callback: new AuthorRequestFilter(authorRequest: $filters->authorRequest))
            ->orderBy(
                column: $sortDto->sortBy,
                direction: $sortDto->sortDir
            )
            ->orderBy(column: 'id', direction: $sortDto->sortDir);
    }

    /**
     * @param \App\Dtos\PageDto $pageDto
     * @param \App\Dtos\Users\UserFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getUsers(
        PageDto  $pageDto,
        UserFilterDto $filters,
        ?SortDto $sortDto = null
    ): LengthAwarePaginator {
        return self::getUserQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }

    /**
     * @return int
     */
    public static function totalActiveUsers(): int
    {
        return DB::table(table: 'users')
            ->count();
    }

    /**
     * @return int
     */
    public static function totalOnlineUsers(): int
    {
        return DB::table(table: 'sessions')
            ->whereNotNull(columns: 'user_id')
            ->where(column: 'last_activity', operator: '>=', value: now()->subMinutes(value: 5)->timestamp)
            ->distinct('user_id')
            ->count();
    }

    /**
     * @return int
     */
    public static function totalAuthorRequest(): int
    {
        return DB::table(table: 'users')
            ->where(column: 'author_request', operator: '=', value: 1)
            ->count();
    }
}
