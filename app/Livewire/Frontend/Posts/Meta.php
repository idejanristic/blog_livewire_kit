<?php

namespace App\Livewire\Frontend\Posts;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Meta extends Component
{
    public ?Post $post = null;
    public bool $showUserLink = false;

     protected $listeners = [
        'comment_created' => 'refreshPost',
        'comment_deleted' => 'refreshPost',
    ];

    public function refreshPost(): void
    {
        $this->post->load(['user.profile', 'comments.user.profile', 'tags']);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.meta'
        );
    }
}
