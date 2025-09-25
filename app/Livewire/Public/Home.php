<?php

namespace App\Livewire\Public;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Home page',
        'description' => 'demo blog is a learning platform where users can display educational content, the most popular posts can be found on this page'
    ]
)]
class Home extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.public.home'
        );
    }
}
