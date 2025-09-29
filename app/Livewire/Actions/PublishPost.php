<?php

namespace App\Livewire\Actions;

use App\Services\PostService;
use App\Repositories\PostRepository;
use App\Traits\Toastable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class PublishPost
{
    use Toastable;

    public function __construct(
        private PostService $postService
    ) {}

    public function __invoke(int $id): RedirectResponse
    {
        $post = PostRepository::find(id: $id);

        Gate::authorize(
            ability: 'publish',
            arguments: $post
        );

        $this->postService->publishe(post: $post);

        $this->toastSuccess(
            withSession: true,
            message: 'Post was published successfully'
        );

        return redirect()->back();
    }
}
