<?php

namespace App\Dtos;

class PostFilterDto
{
    private function __construct(
        public readonly ?string $search = '',
        public readonly ?int $userId = 0,
        public readonly ?int $tagId = 0,
    ) {}

    /**
     * Summary of apply
     * @param array $data
     * @return PostFilterDto
     */
    public static function apply(array $data): PostFilterDto
    {
        return new self(
            search: $data['search'] ?? '',
            userId: $data['userId'] ?? 0,
            tagId: $data['tagId'] ?? 0
        );
    }
}
