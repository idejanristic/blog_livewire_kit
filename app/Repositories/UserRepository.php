<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @return int
     */
    public static function total(): int
    {
        return User::count();
    }
}
