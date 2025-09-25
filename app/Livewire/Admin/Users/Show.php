<?php

namespace App\Livewire\Admin\Users;

use App\Acl\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'User',
        'description' => ''
    ]
)]
class Show extends Component
{
    public User $user;
    public int $selectedRole;
    public Collection $roles;

    public function mount(int $id)
    {
        $this->roles = Role::all();
        $this->user = UserRepository::find(id: $id);
        $this->selectedRole = $this->user->roles[0]->id ?? 0;
    }

    public function updatedSelectedRole(int $roleId): void
    {
        $this->authorize(ability: 'user.menage');

        $userService = app(abstract: UserService::class);

        $userService->updateRole(user: $this->user, roleId: $roleId);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.show'
        );
    }
}
