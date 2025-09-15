<?php

namespace App\Livewire\Frontend\Posts;

use App\Enums\UserAcivityType;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\UserActivityService;
use App\Traits\Toastable;
use Livewire\Component;

class Actions extends Component
{
    use Toastable;

    public Post $post;

    public function delete()
    {
        $this->authorize(
            ability: "delete",
            arguments: $this->post
        );

        $postRepo = app(abstract: PostRepository::class);

        $postRepo->delete($this->post);

        $previous = url()->previous();

        $this->toastSuccess(
            withSession: true,
            message: 'Post deleted successfully'
        );

        UserActivityService::log(
            model: $this->post,
            type: UserAcivityType::Deleted,
            content: 'Post "' . $this->post->title . '" was deleted',
            ip: request()->ip()
        );

        if (str_contains(haystack: $previous, needle: "/posts/{$this->post->id}")) {
            return $this->redirectRoute(name: 'posts.index', navigate: true);
        }

        return $this->redirect(url: $previous, navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.posts.actions');
    }
}
