<?php

namespace App\Livewire\Public;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\ContactForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Contact page',
        'description' => 'it can use the contact page to send suggestions for further work or to send your impressions'
    ]
)]
class Contact extends Component
{
    public ?User $user;
    public ContactForm $form;

    public function mount(): void
    {
        $this->user = Auth::user();
        if ($this->user) {
            $this->form->name = $this->user->name;
            $this->form->email = $this->user->email;
        }
    }

    public function send()
    {
        $user_id = Auth::user()->id ?? null;

        $this->form->store(user_id: $user_id);

        $this->reset();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.contact'
        );
    }
}
