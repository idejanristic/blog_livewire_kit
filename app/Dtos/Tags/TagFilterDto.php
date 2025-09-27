<?php

namespace App\Dtos\Tags;

use App\Enums\PublishedType;

class TagFilterDto
{
    private function __construct(
        public readonly ?string $search = ''
    ) {}

    /**
     * @param array $data
     * @return TagFilterDto
     */
    public static function apply(array $data): self
    {
        return new self(
            search: $data['search'] ?? ''
        );
    }
}
