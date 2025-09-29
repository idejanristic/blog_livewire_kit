<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Traits\UserActivitiable;
use Livewire\Component;
use App\Acl\Models\Role;
use App\Acl\Enums\RoleType;
use App\Acl\Enums\UserSource;
use App\Enums\UserAcivityType;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    use UserActivitiable;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['source'] = UserSource::APP;

        event(new Registered(($user = User::create($validated))));

        $role = Role::where(column: 'slug', operator: RoleType::SUBSCRIBER)->firstOrFail();

        $user->assignRole($role->id);

        $this->activity(
            model: $user,
            type: UserAcivityType::CREATED,
            content: "Post \'{$user->email}\' was registered"
        );

        Auth::login($user);

        $this->redirect(route('admin.dashboard', absolute: false), navigate: true);
    }
}
