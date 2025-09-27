<?php

namespace App\Dtos\Feedbacks;

use App\Enums\PublishedType;

class FeedbackFilterDto
{
    private function __construct(
        public readonly ?string $search = '',
        public readonly ?int $userId = 0
    ) {}

    /**
     * @param array $data
     * @return FeedbackFilterDto
     */
    public static function apply(array $data): self
    {
        return new self(
            search: $data['search'] ?? '',
            userId: $data['userId'] ?? 0
        );
    }
}
