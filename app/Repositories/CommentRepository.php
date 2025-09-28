<?php

namespace App\Repositories;

use App\Dtos\Comments\CommentDto;
use App\Dtos\Comments\CommentFilterDto;
use App\Dtos\PageDto;
use App\Dtos\SortDto;
use App\Models\Comment;
use App\Repositories\Filters\Comments\PostFilter;
use App\Repositories\Filters\Comments\SearchFilter;
use App\Repositories\Filters\UserFilter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

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
     * @param int $id
     * @return Comment|null
     */
    public static function find(int $id): Comment|null
    {
        return self::getCommentRelationQuery()
            ->where(column: 'id', operator: $id)
            ->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Comment>
     */
    private static function getCommentRelationQuery()
    {
        return Comment::query()
            ->with(relations: [
                'user.profile',
                'post'
            ]);
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

        return self::getCommentRelationQuery()
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new UserFilter(userId: $filters->userId))
            ->tap(callback: new PostFilter(postId: $filters->postId))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir);
    }

    /**
     * @param \App\Dtos\PageDto $pageDto
     * @param \App\Dtos\Comments\CommentFilterDto $filters
     * @param mixed $sortDto
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getComments(PageDto $pageDto, CommentFilterDto $filters, ?SortDto $sortDto = null): Paginator
    {
        if ($filters === null) {
            $filters = new CommentFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getCommentsQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }

    /**
     * @param int $postId
     * @param mixed $sortDto
     * @return Collection<int, Comment>
     */
    public static function getPostComments(int $postId, ?SortDto $sortDto = null): Collection
    {
        $filters = CommentFilterDto::apply(data: [
            'postId' => $postId,
        ]);

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getCommentsQuery(filters: $filters, sortDto: $sortDto)
            ->get();
    }
}
