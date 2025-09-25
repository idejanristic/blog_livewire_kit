<?php

namespace App\Livewire\Public;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'About page',
        'description' => 'About me'
    ]
)]
class About extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.public.about'
        );
    }
}
