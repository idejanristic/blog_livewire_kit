<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class PostList extends Component
{
    public function posts(): Collection
    {
        return Post::with(relations: 'user')
            ->latest()
            ->take(3)
            ->get();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.home.post-list',
            data: [
                'posts' => $this->posts()
            ]
        );
    }
}
