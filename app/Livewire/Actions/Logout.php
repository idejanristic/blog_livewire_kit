<?php

namespace App\Livewire\Actions;

use App\Dtos\Activities\ActivityDto;
use App\Enums\UserAcivityType;
use App\Services\UserActivityService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        $user = auth()->user();

        UserActivityService::log(
            dto: ActivityDto::apply(
                data: [
                    'model' => $user,
                    'type' => UserAcivityType::Logout,
                    'content' => 'User "' . $user->email . '" was logout',
                    'ip' => request()->ip()
                ]
            )
        );

        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
