<?php

namespace App\Livewire\Public\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Post',
        'description' => ''
    ]
)]
class Show extends Component
{
    public Post $post;

    public function mount(int $id): void
    {
        $this->post = PostRepository::find(id: $id);
    }

    public function render(): View
    {
        $this->post->increment(column: 'view_count');

        return view(
            view: 'livewire.public.posts.show'
        );
    }
}
