<?php

namespace App\Dtos\Activities;

class ActivityFilterDto
{
    private function __construct(
        public readonly ?string $search = '',
        public readonly ?int $userId = 0
    ) {}

    /**
     * @param array $data
     * @return ActivityFilterDto
     */
    public static function apply(array $data): self
    {
        return new self(
            search: $data['search'] ?? '',
            userId: $data['userId'] ?? 0
        );
    }
}
