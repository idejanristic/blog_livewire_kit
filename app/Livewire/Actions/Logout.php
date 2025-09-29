<?php

namespace App\Livewire\Actions;

use App\Enums\UserAcivityType;
use App\Traits\UserActivitiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    use UserActivitiable;
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        $user = Auth::user();

        $this->activity(
            model: $user,
            type: UserAcivityType::LOGOUT,
            content: "User \'{$user->email}\' was logout"
        );

        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
