<?php

namespace App\Dtos\Comments;

class CommentDto
{
    public function __construct(
        public readonly string $body,
        public readonly int $user_id,
        public readonly int $post_id
    ) {}

    public static function apply(array $data): CommentDto
    {
        return new self(
            body: $data['body'],
            user_id: $data['user_id'],
            post_id: $data['post_id']
        );
    }
}
