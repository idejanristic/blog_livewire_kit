<?php

namespace App\Livewire\Components\Posts;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Meta extends Component
{
    public ?Post $post = null;
    public bool $showUserLink = false;

    public function render(): View
    {
        return view(
            view: 'livewire.components.posts.meta'
        );
    }
}
