<?php

namespace App\Dtos\Roles;

class RoleDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description = null,
        public readonly ?array $permissions = []
    ) {}

    public static function apply(array $data): self
    {
        return new RoleDto(
            name: $data['name'],
            description: $data['description'],
            permissions: $data['permissions']
        );
    }
}
