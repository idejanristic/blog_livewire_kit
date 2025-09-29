<?php

namespace App\Livewire\Public\Settings;

use App\Livewire\Forms\ProfileForm;
use App\Models\User;
use App\Models\Profile;
use App\Traits\Toastable;
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
    use WithFileUploads, Toastable;

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
        try {
            $profile = $this->form->store(user_id: $this->user->id);

            if (!$profile) {
                $this->toastError(
                    withSession: true,
                    message: 'Profile wasn\'t deleted'
                );

                return $this->redirectRoute(
                    name: 'settings.profile',
                    navigate: true
                );
            }

            $this->toastSuccess(
                withSession: true,
                message: 'Profile was created'
            );

            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        } catch (\Throwable $e) {
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
            );

            $this->resetErrorBag();
        }
    }

    public function update()
    {
        try {
            $profile = $this->user->profile;

            $this->form->update(profile: $profile);

            $this->toastSuccess(
                withSession: true,
                message: 'Profile was updated'
            );

            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        } catch (\Throwable $e) {
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
            );

            $this->resetErrorBag();
        }
    }

    public function delete()
    {
        try {
            if ($this->user->profile) {
                $profile = $this->user->profile;

                $this->form->delete(profile: $profile);

                $this->toastSuccess(
                    withSession: true,
                    message: 'Profile waw deleted'
                );

                return $this->redirectRoute(
                    name: 'settings.profile',
                    navigate: true
                );
            }
        } catch (\Throwable $e) {
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
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
