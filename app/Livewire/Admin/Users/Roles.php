<?php

namespace App\Livewire\Admin\Users;

use App\Acl\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'All roles',
        'description' => ''
    ]
)]
class Roles extends Component
{
    public function render(): View
    {

        return view(
            view: 'livewire.admin.users.roles'
        );
    }
}
