<?php

namespace App\Livewire\Frontend\Settings;

use App\Dtos\Activities\ActivityDto;
use App\Enums\UserAcivityType;
use App\Livewire\Forms\ProfileForm;
use App\Models\User;
use Livewire\Component;
use App\Services\UserActivityService;
use App\Traits\Toastable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout(
    name: 'components.layouts.frontend.app',
    params: [
        'title' => 'Settings - profile',
        'description' => ''
    ]
)]
class Profile extends Component
{
    use Toastable;
    public User $user;

    public ProfileForm $form;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $profile = $user->profile;

        $this->user = $user;

        $this->form->setProfile(profile: $profile);
    }

    public function store()
    {
        try {
            $profile = $this->form->store(user_id: $this->user->id);

            if (!$profile) {
                $this->toastError(
                    withSession: true,
                    message: 'Profile not created'
                );

                return $this->redirectRoute(
                    name: 'settings.profile',
                    navigate: true
                );
            }

            $this->toastSuccess(
                withSession: true,
                message: 'Profile created successfully'
            );

            UserActivityService::log(
                dto: ActivityDto::apply(
                    data: [
                        'model' => $profile,
                        'type' =>  UserAcivityType::Created,
                        'content' =>  'Profile for user "' . $this->user->email . '" was created',
                        'ip' =>  request()->ip()
                    ]
                )
            );

            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        } catch (\Throwable $e) {

            $this->toastError(
                withSession: false,
                message: $e->getMessage()
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
                message: 'Post edited successfully'
            );

            UserActivityService::log(
                dto: ActivityDto::apply(
                    data: [
                        'model' =>  $profile,
                        'type' =>  UserAcivityType::Updated,
                        'content' =>  'Profile for user "' . $this->user->email . '" was udpated',
                        'ip' => request()->ip()
                    ]
                )
            );

            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        } catch (\Throwable $e) {

            $this->toastError(
                withSession: false,
                message: $e->getMessage()
            );

            $this->resetErrorBag();
        }
    }

    public function delete()
    {
        if ($this->user->profile) {
            $profile = $this->user->profile;

            $this->form->delete(profile: $profile);

            UserActivityService::log(
                dto: ActivityDto::apply(
                    data: [
                        'model' =>  $profile,
                        'type' =>  UserAcivityType::Deleted,
                        'content' =>  'Profile for user "' . $this->user->email . '" was deleted',
                        'ip' => request()->ip()
                    ]
                )
            );

            $this->toastSuccess(
                withSession: true,
                message: 'Post deleted successfully'
            );

            return $this->redirectRoute(
                name: 'settings.profile',
                navigate: true
            );
        }
    }

    public function render(): View
    {
        return view(view: 'livewire.frontend.settings.profile');
    }
}
