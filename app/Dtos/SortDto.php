<?php

namespace App\Dtos;

class SortDto
{
    public function __construct(
        public readonly ?string $sortBy = 'created_at',
        public readonly ?string $sortDir = 'DESC'
    ) {}

    public static function apply(array $data): self
    {
        return new self(
            sortBy: $data['sortBy'] ?? 'created_at',
            sortDir: $data['sortDir'] ?? 'DESC'
        );
    }
}
