<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * @param \App\Models\User $user
     * @param int $roleId
     * @return void
     */
    public function updateRole(User $user, int $roleId): void
    {
        $user->assignRole(role_id: $roleId);

        $this->removeAuthorRequest(user: $user);
    }

    /**
     * @param \App\Models\User $user
     * @return bool|null
     */
    public function delete(User $user): bool|null
    {
        return $this->userRepository->delete(user: $user);
    }

    /**
     * @param mixed $user
     * @return bool
     */
    public function removeAuthorRequest($user): bool
    {
        return $user->update(
            attributes: [
                'author_request' => 0
            ]
        );
    }
}
