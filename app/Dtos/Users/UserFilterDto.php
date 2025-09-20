<?php

namespace App\Dtos\Users;

class UserFilterDto
{
    public function __construct(
        public readonly string $search = ''
    ) {}

    public static function apply(array $data): UserFilterDto
    {
        return new self(
            search: $data['search']
        );
    }
}
