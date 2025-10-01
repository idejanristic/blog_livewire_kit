<?php

namespace App\Dtos\Posts;

use App\Enums\PublishedType;
use App\Enums\TrashedType;

class PostFilterDto
{
    private function __construct(
        public readonly ?string $search = '',
        public readonly ?int $userId = 0,
        public ?PublishedType $publishedType = PublishedType::ALL,
        public ?int $tagId = 0,
        public readonly ?TrashedType $trashedType = null
    ) {}

    /**
     * @param array $data
     * @return PostFilterDto
     */
    public static function apply(array $data): PostFilterDto
    {
        return new self(
            search: $data['search'] ?? '',
            userId: $data['userId'] ?? 0,
            publishedType: $data['publishedType'] ?? PublishedType::ALL,
            tagId: $data['tagId'] ?? 0,
            trashedType: $data['trashedType']
        );
    }
}
