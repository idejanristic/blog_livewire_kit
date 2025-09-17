<?php

namespace App\Services;

use App\Dtos\Comments\CommentDto;
use App\Models\Comment;
use App\Repositories\CommentRepository;

class CommentService
{
    public function __construct(
        private CommentRepository $commentRepository
    ) {}

    /**
     * @param \App\Dtos\Comments\CommentDto $dto
     * @return Comment
     */
    public function create(CommentDto $dto): Comment
    {
        return $this->commentRepository
            ->create(dto: $dto);
    }

    /**
     * @param \App\Dtos\Comments\CommentDto $dto
     * @param \App\Models\Comment $comment
     * @return bool
     */
    public function update(CommentDto $dto, Comment $comment): bool
    {
        return $this->commentRepository
            ->update(dto: $dto, comment: $comment);
    }

    /**
     * @param \App\Models\Comment $comment
     * @return bool|null
     */
    public function delete(Comment $comment): bool
    {
        return $this->commentRepository
            ->delete(comment: $comment);
    }
}
