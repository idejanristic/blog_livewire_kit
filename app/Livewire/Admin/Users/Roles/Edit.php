<?php

namespace App\Livewire\Admin\Users\Roles;

use Livewire\Component;
use App\Acl\Models\Role;
use App\Acl\Models\Permission;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Edit role',
        'description' => ''
    ]
)]
class Edit extends Component
{
    public Role $role;
    public array $permissions;

    public function mount(int $id): void
    {
        $this->role = RoleRepository::find(id: $id);
        $this->permissions = Permission::select('id', 'name', 'slug', 'description')->get()->toArray();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.roles.edit'
        );
    }
}
