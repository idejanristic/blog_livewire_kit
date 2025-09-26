<?php

namespace App\Livewire\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthorRequest
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): RedirectResponse
    {
        $user = Auth::user();

        $user->update(attributes: [
            'author_request' => true
        ]);

        return redirect()->back();
    }
}
