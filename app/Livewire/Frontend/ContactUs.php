<?php

namespace App\Livewire\Frontend;

use App\Livewire\Forms\ContactForm;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactUs extends Component
{
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
        $user_id = auth()->user()->id ?? null;

        $post = $this->form->store(user_id: $user_id);

        $this->reset();

        // $this->dispatch(event: 'toast', title: 'Success!!!', message: 'Uspešno sačuvano!');

        // Success poruka
        // $this->dispatch('toast', [
        //     'title' => 'Uspeh!',
        //     'message' => 'Podaci su sačuvani.',
        //     'type' => 'success'
        // ]);

        // // // Error poruka
        // $this->dispatch('toast', [
        //     'title' => 'Greška!',
        //     'message' => 'Nešto nije u redu.',
        //     'type' => 'error',
        //     'duration' => 6000, // opcionalno, 6s
        // ]);
    }

    public function render(): View
    {
        return view(view: 'livewire.frontend.contact-us');
    }
}
