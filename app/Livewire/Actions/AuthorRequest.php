<?php

namespace App\Livewire\Actions;

use App\Traits\Toastable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthorRequest
{
    use Toastable;

    /**
     * Log the current user out of the application.
     */
    public function __invoke(): RedirectResponse
    {
        $user = Auth::user();

        $user->update(attributes: [
            'author_request' => true
        ]);

        $this->toastSuccess(
            withSession: true,
            message: 'User was sent request for author role'
        );

        return redirect()->back();
    }
}
