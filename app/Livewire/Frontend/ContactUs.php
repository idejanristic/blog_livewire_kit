<?php

namespace App\Livewire\Frontend;

use App\Enums\UserAcivityType;
use App\Livewire\Forms\ContactForm;
use App\Models\User;
use App\Services\UserActivityService;
use App\Traits\Toastable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactUs extends Component
{
    use Toastable;

    public ?User $user;
    public ContactForm $form;

    public function mount(): void
    {
        $this->user = auth()->user();
        if (auth()->user()) {
            $this->form->name = $this->user->name;
            $this->form->email = $this->user->email;
        }
    }

    public function send()
    {
        $user = auth()->user() ?? null;

        $feeeback = $this->form->store(user_id: $user->id);

        $this->reset();

        UserActivityService::log(
            model: $feeeback,
            type: UserAcivityType::Sent,
            content: 'User "' . $user->email . '" was sent',
            ip: request()->ip()
        );

        $this->toastSuccess(
            withSession: false,
            message: 'Message sent successfully'
        );
    }

    public function render(): View
    {
        return view(view: 'livewire.frontend.contact-us');
    }
}
