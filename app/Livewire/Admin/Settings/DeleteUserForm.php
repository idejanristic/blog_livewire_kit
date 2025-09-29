<?php

namespace App\Livewire\Admin\Settings;

use App\Traits\Toastable;
use Livewire\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

class DeleteUserForm extends Component
{
    use Toastable;

    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->toastSuccess(
            withSession: true,
            message: 'Account was deleted'
        );

        $this->redirect('/', navigate: true);
    }
}
