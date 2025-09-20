<?php

namespace App\Repositories;

use App\Dtos\Comments\CommentDto;
use App\Dtos\Comments\CommentFilterDto;
use App\Dtos\SortDto;
use App\Models\Comment;
use App\Repositories\Filters\Comments\SearchFilter;
use App\Repositories\Filters\UserFilter;
use Illuminate\Contracts\Pagination\Paginator;

class CommentRepository
{
    /**
     * @param \App\Dtos\Comments\CommentDto $dto
     * @return Comment
     */
    public function create(CommentDto $dto): Comment
    {
        return Comment::create(
            attributes: [
                'body' => $dto->body,
                'user_id' => $dto->user_id,
                'post_id' => $dto->post_id
            ]
        );
    }

    /**
     * @param \App\Dtos\Comments\CommentDto $dto
     * @param \App\Models\Comment $comment
     * @return bool
     */
    public function update(CommentDto $dto, Comment $comment): bool
    {
        return $comment->update(
            attributes: [
                'body' => $dto->body,
                'user_id' => $dto->user_id,
                'post_id' => $dto->post_id
            ]
        );
    }

    /**
     * @param \App\Models\Comment $comment
     * @return bool|null
     */
    public function delete(Comment $comment): bool
    {
        return $comment->delete();
    }

    /**
     * @return int
     */
    public static function total(): int
    {
        return Comment::count();
    }

    /**
     * @param \App\Dtos\Comments\CommentFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Database\Eloquent\Builder<Comment>
     */
    private static function getCommentsQuery(CommentFilterDto $filters, ?SortDto $sortDto = null)
    {
        if ($filters === null) {
            $filters = new CommentFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return Comment::query()
            ->with(relations: [
                'user.profile'
            ])
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new UserFilter(userId: $filters->userId))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir);
    }

    /**
     * @param int $perPage
     * @param \App\Dtos\Comments\CommentFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getComments(int $perPage = 6, CommentFilterDto $filters, ?SortDto $sortDto = null): Paginator
    {
        if ($filters === null) {
            $filters = new CommentFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return  self::getCommentsQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(perPage: $perPage);
    }
}
