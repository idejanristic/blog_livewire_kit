<?php

namespace App\Livewire\Admin\Settings;

use App\Traits\Toastable;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Attributes\Layout;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Password',
        'description' => ''
    ]
)]
class Password extends Component
{
    use Toastable;

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword()
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', PasswordRule::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');

        $this->toastSuccess(
            withSession: true,
            message: 'Password was chenaged'
        );

        return $this->redirectRoute(
            name: 'admin.settings.password',
            navigate: true
        );
    }
}
