<?php

namespace App\Livewire\Components\Users\Roles;

use Livewire\Component;
use App\Acl\Models\Role;
use App\Enums\UserAcivityType;
use App\Traits\Toastable;
use App\Livewire\Forms\RoleForm;
use App\Traits\UserActivitiable;
use Illuminate\Contracts\View\View;

class Form extends Component
{
    use Toastable, UserActivitiable;

    public Role $role;

    public RoleForm $form;

    public array $permissions = [];

    public function mount(Role $role, array $permissions): void
    {
        if ($role->exists) {
            $this->form->setRole(role: $role);
            $this->role = $role;
        }

        $this->permissions = $permissions;
    }

    public function store()
    {
        try {
            $role = $this->form->store();

            if (!$role) {
                $this->toastError(
                    withSession: false,
                    message: 'Oops! Something went wrong',
                );
                return;
            }

            $this->toastSuccess(
                withSession: true,
                message: 'Role was created successfully'
            );

            $this->activity(
                model: $role,
                type: UserAcivityType::CREATED,
                content: "Role \'{$role->name}\' was created"
            );

            return $this->redirectRoute(
                name: 'admin.users.roles',
                navigate: true
            );
        } catch (\Throwable $e) {
            dd($e->getMessage());
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
            );

            $this->resetErrorBag();
        }
    }

    public function update()
    {
        try {
            $role = $this->role;

            $this->form->update(role: $role);

            $this->reset();

            $this->toastSuccess(
                withSession: true,
                message: 'Role was updated successfully'
            );

            $this->activity(
                model: $role,
                type: UserAcivityType::UPDATED,
                content: "Role \'{$role->name}\' was update"
            );

            return $this->redirectRoute(
                name: 'admin.users.roles',
                parameters: ['id' => $role->id],
                navigate: true
            );
        } catch (\Throwable $e) {
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
            );

            $this->resetErrorBag();
        }
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.users.roles.form'
        );
    }
}
