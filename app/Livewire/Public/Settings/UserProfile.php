<?php

namespace App\Livewire\Public\Settings;

use App\Livewire\Forms\ProfileForm;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Profile',
        'description' => ''
    ]
)]
class UserProfile extends Component
{
    use WithFileUploads;

    public User $user;
    public ProfileForm $form;

    public ?Profile $profile;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->profile = $user->profile;

        $this->user = $user;

        $this->form->setProfile(profile: $this->profile);
    }

    public function store()
    {
        $profile = $this->form->store(user_id: $this->user->id);

        if (!$profile) {
            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        }


        return $this->redirectRoute(
            name: 'settings.profile',
            navigate: true
        );
    }

    public function update()
    {
        $profile = $this->user->profile;

        $this->form->update(profile: $profile);

        return $this->redirectRoute(
            name: 'settings.profile',
            navigate: true
        );
    }

    public function delete()
    {
        if ($this->user->profile) {
            $profile = $this->user->profile;

            $this->form->delete(profile: $profile);

            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        }
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.settings.profile'
        );
    }
}
