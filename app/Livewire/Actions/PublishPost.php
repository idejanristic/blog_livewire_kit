<?php

namespace App\Livewire\Actions;

use App\Services\PostService;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class PublishPost
{

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

        return redirect()->back();
    }
}
