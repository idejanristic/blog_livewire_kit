<?php

namespace App\Repositories;

use App\Dtos\PageDto;
use App\Dtos\SortDto;
use App\Models\Feedback;
use App\Dtos\Feedbacks\FeedbackDto;
use App\Repositories\Filters\UserFilter;
use App\Dtos\Feedbacks\FeedbackFilterDto;
use App\Repositories\Filters\Feedbacks\SearchFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FeedbackRepository
{
    /**
     * @param \App\Dtos\Feedbacks\FeedbackDto $dto
     * @param mixed $userId
     * @return Feedback
     */
    public function create(FeedbackDto $dto, ?int $userId): Feedback
    {
        return Feedback::create(
            attributes: [
                'name' => $dto->name,
                'email' => $dto->email,
                'message' => $dto->message,
                'phone' => $dto->phone,
                'user_id' => $userId ?? null
            ]
        );
    }

    /**
     * @param \App\Dtos\Feedbacks\FeedbackDto  $dto
     * @param \App\Models\Feedback $feedback
     * @return bool
     */
    public function update(FeedbackDto $dto, Feedback $feedback): bool
    {
        return $feedback->update(
            attributes: [
                'name' => $dto->name,
                'email' => $dto->email,
                'message' => $dto->message,
                'phone' => $dto->phone
            ]
        );
    }

    /**
     * @param \App\Models\Feedback $feedback
     * @return bool|null
     */
    public function delete(Feedback $feedback): bool
    {
        return $feedback->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Feedback>
     */
    private static function getFeedbackRelationQuery()
    {
        return Feedback::query()
            ->with(relations: [
                'user.roles',
                'user.sessions'
            ]);
    }

    /**
     * @param \App\Dtos\Feedbacks\FeedbackFilterDto $filters
     * @param \App\Dtos\SortDto $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<Feedback>
     */
    private static function getFeedbacksQuery(FeedbackFilterDto $filters, SortDto $sortDto)
    {
        return self::getFeedbackRelationQuery()
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new UserFilter(userId: $filters->userId))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir)
            ->orderBy(column: 'id', direction: $sortDto->sortDir);
    }

    /**
     * @param \App\Dtos\PageDto $pageDto
     * @param mixed $filters
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getFeedbacks(
        PageDto $pageDto,
        ?FeedbackFilterDto $filters,
        ?SortDto $sortDto
    ): LengthAwarePaginator {

        if ($filters === null) {
            $filters = new FeedbackFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getFeedbacksQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }

    /**
     * @param int $id
     * @return Feedback|null
     */
    public static function find(int $id): Feedback|null
    {
        return self::getFeedbackRelationQuery()
            ->where(column: 'id', operator: $id)
            ->first();
    }
}
