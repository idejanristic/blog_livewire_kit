<?php

namespace App\Dtos\Roles;

class RoleFilterDto
{
    private function __construct(
        public readonly ?string $search = ''
    ) {}

    /**
     * @param array $data
     * @return RoleFilterDto
     */
    public static function apply(array $data): RoleFilterDto
    {
        return new self(
            search: $data['search'] ?? ''
        );
    }
}
