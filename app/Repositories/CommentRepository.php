<?php

namespace App\Repositories;

use App\Dtos\Comments\CommentDto;
use App\Models\Comment;

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
}
