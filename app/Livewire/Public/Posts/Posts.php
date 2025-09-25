<?php

namespace App\Livewire\Public\Posts;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Posts',
        'description' => 'All posts from The Blog"'
    ]
)]
class Posts extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.public.posts.posts'
        );
    }
}
