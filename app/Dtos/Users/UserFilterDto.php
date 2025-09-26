<?php

namespace App\Dtos\Users;

use App\Enums\TrashedType;

class UserFilterDto
{
    public function __construct(
        public readonly string $search = '',
        public readonly TrashedType $trashedType = TrashedType::ALL,
        public ?bool $authorRequest = false
    ) {}

    public static function apply(array $data): UserFilterDto
    {
        return new self(
            search: $data['search'],
            trashedType: $data['trashedType'] ?? TrashedType::ALL,
            authorRequest: $data['authorRequest'] ?? false
        );
    }
}
