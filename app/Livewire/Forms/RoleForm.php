<?php

namespace App\Livewire\Forms;

use App\Acl\Models\Role;
use Livewire\Form;
use App\Dtos\Roles\RoleDto;
use App\Services\RoleService;
use Livewire\Attributes\Validate;

class RoleForm extends Form
{
    #[Validate(rule: 'required|string|min:3|max:56')]
    public ?string $name = null;
    #[Validate(rule: 'required|string|min:3|max:255')]
    public ?string $description = null;
    #[Validate(rule: 'array')]
    public array $permissions = [];

    public function setRole(Role $role)
    {
        $this->name = $role->name;
        $this->description = $role->description ?? null;
        $this->permissions = $role->permissions->pluck('id')->toArray();
    }

    public function store()
    {
        $validated =  $this->validate();;
        $roleService = app(abstract: RoleService::class);

        return $roleService->create(
            dto: RoleDto::apply(
                data: $validated
            )
        );
    }

    public function update(Role $role): bool
    {
        $validated =  $this->validate();

        $roleService = app(abstract: RoleService::class);

        return $roleService->update(
            dto: RoleDto::apply(
                data: $validated
            ),
            role: $role
        );
    }
}
