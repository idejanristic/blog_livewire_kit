<?php

namespace App\Livewire\Actions;

use App\Acl\Enums\RoleType;
use App\Acl\Models\Role;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class AddAuthorRole
{

    public function __construct(
        private UserService $userService
    ) {}

    public function __invoke(int $id): RedirectResponse
    {
        $user = UserRepository::find(id: $id);

        $authorRole = Role::where(column: 'slug', operator: RoleType::AUTHOR)->firstOrFail();

        $this->userService->updateRole(user: $user, roleId: $authorRole->id);

        return redirect()->back();
    }
}
