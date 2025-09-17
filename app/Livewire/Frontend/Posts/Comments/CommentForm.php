<?php

namespace App\Livewire\Frontend\Posts\Comments;

use App\Dtos\Activities\ActivityDto;
use App\Dtos\Comments\CommentDto;
use App\Enums\UserAcivityType;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\CommentService;
use App\Services\UserActivityService;
use App\Traits\Toastable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentForm extends Component
{
    use Toastable;

    public ?User $user = null;

    public ?Post $post = null;

    #[Validate(rule: 'required|string|min:3|max:1024', as: 'comment')]
    public string $body = '';

    public function store(): void
    {
        $validated =  $this->validate();

        $commentService = app(abstract: CommentService::class);

        $validated['user_id'] = $this->user->id;
        $validated['post_id'] = $this->post->id;

        $comment = $commentService->create(
            dto: CommentDto::apply(data: $validated)
        );

        if (!$comment) {
            $this->toastError(
                withSession: false,
                message: 'Comment not created'
            );
            return;
        }

        $this->toastSuccess(
            withSession: false,
            message: 'Comment added successfully'
        );

        UserActivityService::log(
            dto: ActivityDto::apply(
                data: [
                    'model' => $comment,
                    'type' =>  UserAcivityType::Created,
                    'content' =>  'Post "' . $this->post->title . '" was comented',
                    'ip' =>  request()->ip()
                ]
            )
        );

        $this->dispatch(event: 'comment_created');

        $this->reset( 'body');
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.comments.comment-form'
        );
    }
}
