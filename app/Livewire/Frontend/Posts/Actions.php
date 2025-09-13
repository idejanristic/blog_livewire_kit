<?php

namespace App\Livewire\Frontend\Posts;

use App\Models\Post;
use App\Repositories\PostRepository;
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

        if (str_contains(haystack: $previous, needle: "/posts/{$this->post->id}")) {
            return $this->redirectRoute(name: 'posts.index', navigate: true);
        }

        $this->toastSuccess(
            withSession: false,
            message: 'Post deleted successfully'
        );

        return $this->redirect(url: $previous, navigate: true);
    }



    public function render()
    {
        return view('livewire.frontend.posts.actions');
    }
}
