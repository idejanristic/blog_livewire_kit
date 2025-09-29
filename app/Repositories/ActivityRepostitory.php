<?php

namespace App\Repositories;

use App\Models\UserActivity;
use App\Dtos\Activities\ActivityDto;
use App\Repositories\Filters\UserFilter;
use App\Dtos\Activities\ActivityFilterDto;
use App\Dtos\PageDto;
use App\Dtos\SortDto;
use Illuminate\Contracts\Pagination\Paginator;
use App\Repositories\Filters\Activities\SearchFilter;

class ActivityRepostitory
{
    /**
     * @param \App\Dtos\Activities\ActivityDto $dto
     * @param int $userId
     * @return UserActivity
     */
    public function create(ActivityDto $dto, int $userId): UserActivity
    {
        return UserActivity::create(attributes: [
            'ip_address' => $dto->ip,
            'user_id' => $userId,
            'type' => $dto->type,
            'model' => class_basename(class: $dto->model),
            'model_id' => $dto->model->id,
            'content' => $dto->content
        ]);
    }

    /**
     * @param \App\Dtos\Activities\ActivityFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<UserActivity>
     */
    private static function getActivitiesQuery(ActivityFilterDto $filters, ?SortDto $sortDto = null)
    {
        if ($filters === null) {
            $filters = new ActivityFilterDto();
        }

        return UserActivity::query()
            ->with(relations: [
                'user'
            ])
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new UserFilter(userId: $filters->userId))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir)
            ->orderBy(column: 'id', direction: $sortDto->sortDir);
    }


    /**
     * @param \App\Dtos\PageDto $pageDto
     * @param \App\Dtos\Activities\ActivityFilterDto $filters
     * @param \App\Dtos\SortDto $sortDto
     * @return Paginator
     */
    public static function getActivities(PageDto $pageDto, ActivityFilterDto $filters, SortDto $sortDto): Paginator
    {
        if ($filters === null) {
            $filters = new ActivityFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new $sortDto();
        }

        return  self::getActivitiesQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }

    /**
     * @param \App\Dtos\Activities\ActivityFilterDto $filters
     * @return int
     */
    public static function getTotalNumberActivities(ActivityFilterDto $filters): int
    {
        if ($filters === null) {
            $filters = new ActivityFilterDto();
        }

        return  self::getActivitiesQuery(filters: $filters)
            ->count();
    }
}
