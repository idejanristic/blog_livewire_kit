<?php

namespace  App\Services;

use App\Dtos\Activities\ActivityDto;
use App\Repositories\ActivityRepostitory;

class UserActivityService
{
    public function __construct(
        private ActivityRepostitory $activityRepostitory
    ) {}

    /**
     * Summary of log
     * @param object $model
     * @param string $content
     * @param string $ip
     * @return void
     */
    public static function log(ActivityDto $dto): void
    {
        if (auth()->user()) {
            $activityRepostitory = app(abstract: ActivityRepostitory::class);

            $activityRepostitory->create(
                dto: $dto,
                userId: auth()->user()->id
            );
        }
    }
}
