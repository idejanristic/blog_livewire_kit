<?php

namespace App\Livewire\Frontend\Settings;

use App\Models\User;
use App\Services\TagService;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

#[Layout(
    name: 'components.layouts.frontend.app',
    params: [
        'title' => 'Settings - profile',
        'description' => 'Update your name and email address'
    ]
)]
class Profile extends Component
{
    public string $name = '';

    public string $email = '';

    public $allTags = [];
    public int $tagId = 0;

    /**
     * Mount the component.
     */
    public function mount(TagService $tagService): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;

        $this->allTags = $tagService->getAllTags();
        $this->tagId = (int) request()->query('tag', 0);
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(table: User::class)->ignore(id: $user->id),
            ],
        ]);

        $user->fill(attributes: $validated);

        if ($user->isDirty(attributes: 'email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch(event: 'profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route(name: 'user.center.show', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash(key: 'status', value: 'verification-link-sent');
    }
}
