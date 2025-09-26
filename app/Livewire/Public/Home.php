<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;


#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Home page',
        'description' => 'demo blog is a learning platform where users can display educational content, the most popular posts can be found on this page'
    ]
)]
class Home extends Component
{
    #[Computed]
    public function posts(): Collection
    {
        return PostRepository::getMostViewPosts(perPage: 3);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.home',
            data: [
                'posts' => $this->posts()
            ]
        );
    }
}
