<?php

namespace App\Livewire\Actions;

use App\Acl\Enums\RoleType;
use App\Acl\Models\Role;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class RestoreUser
{

    public function __construct(
        private UserService $userService
    ) {}

    public function __invoke(int $id): RedirectResponse
    {
        $user = UserRepository::find(id: $id);

        $this->userService->restore(user: $user);

        return redirect()->back();
    }
}
