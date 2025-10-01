<?php

namespace App\Livewire\Admin\Users\Permissions;

use App\Acl\Models\Permission;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Permissions',
        'description' => ''
    ]
)]
class Show extends Component
{
    public Permission $permission;

    public function mount(int $id)
    {
        $this->permission = Permission::findOrFail($id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.permissions.show'
        );
    }
}
