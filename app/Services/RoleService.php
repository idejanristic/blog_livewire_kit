<?php

namespace App\Services;

use App\Acl\Models\Role;
use App\Dtos\Roles\RoleDto;
use App\Repositories\RoleRepository;

class RoleService
{
    public function __construct(
        private RoleRepository $roleRepository
    ) {}

    /**
     * @param \App\Dtos\Roles\RoleDto $dto
     * @return Role
     */
    public function create(RoleDto $dto): Role
    {
        $role = $this->roleRepository
            ->create(dto: $dto);

        if ($role && count(value: $dto->permissions) > 0) {
            $this->roleRepository
                ->permissionSync(dto: $dto, role: $role);
        }

        return $role;
    }

    /**
     * @param \App\Dtos\Roles\RoleDto $dto
     * @param \App\Acl\Models\Role $role
     * @return bool
     */
    public function update(RoleDto $dto, Role $role): bool
    {
        $status = $this->roleRepository
            ->update(dto: $dto, role: $role);

        if ($role && count(value: $dto->permissions) > 0) {
            $this->roleRepository
                ->permissionSync(dto: $dto, role: $role);
        }

        return $status;
    }

    /**
     * @param mixed $role
     * @return bool|null
     */
    public function delete($role): bool|null
    {
        return $this->roleRepository
            ->delete(role: $role);
    }
}
