<?php

namespace App\Livewire\Public\UserCentar;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Create post',
        'description' => 'form form create post'
    ]
)]
class CreatePost extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.public.user-centar.create-post'
        );
    }
}
