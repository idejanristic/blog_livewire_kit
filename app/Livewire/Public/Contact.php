<?php

namespace App\Livewire\Public;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Contact page',
        'description' => 'it can use the contact page to send suggestions for further work or to send your impressions'
    ]
)]
class Contact extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.public.contact'
        );
    }
}
