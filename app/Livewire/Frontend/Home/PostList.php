<?php

namespace App\Livewire\Frontend\Home;

use App\Repositories\PostRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class PostList extends Component
{
    public function posts(): Collection
    {
        return PostRepository::getFavorityPosts(perPage: 3);
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
