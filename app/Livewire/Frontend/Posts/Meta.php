<?php

namespace App\Livewire\Frontend\Posts;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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

    public function like(): void
    {
        $user = Auth::user();

        if ($user && $user->exists()) {
            $postService = app(abstract: PostService::class);

            $postService->like(post: $this->post, userId: $user->id);

            $this->refreshPost();
        }
    }

    public function dislike(): void
    {
        $user = Auth::user();

        if ($user && $user->exists()) {
            $postService = app(abstract: PostService::class);

            $postService->dislike(post: $this->post, userId: $user->id);

            $this->refreshPost();
        }
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.meta'
        );
    }
}
