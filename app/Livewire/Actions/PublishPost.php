<?php

namespace App\Livewire\Actions;

use App\Enums\UserAcivityType;
use App\Services\PostService;
use App\Repositories\PostRepository;
use App\Traits\Toastable;
use App\Traits\UserActivitiable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class PublishPost
{
    use Toastable, UserActivitiable;

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

        $this->activity(
            model: $post,
            type: UserAcivityType::OTHER,
            content: "Post \'{$post->title}\' was published"
        );

        return redirect()->back();
    }
}
