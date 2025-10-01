<?php

namespace App\Livewire\Admin\Users\Roles;

use Livewire\Component;
use App\Acl\Models\Permission;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Create role',
        'description' => ''
    ]
)]
class Create extends Component
{
    public array $permissions = [];

    public function mount(): void
    {
        $this->permissions = Permission::select('id', 'name', 'slug', 'description')->get()->toArray();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.roles.create'
        );
    }
}
