<?php

namespace App\Repositories;

use App\Models\UserActivity;
use App\Dtos\Activities\ActivityDto;
use App\Repositories\Filters\UserFilter;
use App\Dtos\Activities\ActivityFilterDto;
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
     * @return \Illuminate\Database\Eloquent\Builder<UserActivity>
     */
    private static function getActivitiesQuery(ActivityFilterDto $filters)
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
            ->orderBy(column: 'created_at', direction: 'desc');
    }


    /**
     * @param mixed $perPage
     * @param \App\Dtos\Activities\ActivityFilterDto $filters
     * @return Paginator
     */
    public static function getActivities($perPage = 6, ActivityFilterDto $filters): Paginator
    {
        if ($filters === null) {
            $filters = new ActivityFilterDto();
        }

        return  self::getActivitiesQuery(filters: $filters)
            ->paginate(perPage: $perPage);
    }

    /**
     * Summary of getTotalNumberPosts
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
