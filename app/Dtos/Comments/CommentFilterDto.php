<?php

namespace App\Dtos\Comments;

class CommentFilterDto
{
    private function __construct(
        public readonly ?string $search = '',
        public readonly ?int $userId = 0,
        public readonly ?int $postId = 0
    ) {}

    public static function apply(array $data): self
    {
        return new self(
            search: $data['search'] ?? '',
            userId: $data['userId'] ?? 0,
            postId: $data['postId'] ?? 0
        );
    }
}
