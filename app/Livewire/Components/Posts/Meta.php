<?php

namespace App\Livewire\Components\Posts;

use App\Models\Post;
use App\Repositories\PostRepository;
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
        $id = $this->post->id;

        $this->post = PostRepository::find(id: $id);
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
            view: 'livewire.components.posts.meta'
        );
    }
}
