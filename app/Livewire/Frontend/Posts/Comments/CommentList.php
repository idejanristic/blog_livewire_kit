<?php

namespace App\Livewire\Frontend\Posts\Comments;

use App\Dtos\Activities\ActivityDto;
use App\Enums\UserAcivityType;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\UserActivityService;
use App\Traits\Toastable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CommentList extends Component
{
    use Toastable;

    protected $listeners = [
        'comment_created' => 'refreshComments',
        'comment_delete_event' => 'commentDeleted',
    ];

    public Collection $comments;
    public int $postId;

    public function refreshComments(): void
    {
        $this->loadComments();
    }

    public function commentDeleted(int $id): void
    {
        $comment = Comment::where(column: 'id', operator: $id)->first();

        if (! $comment) {
            $this->toastError(
                withSession: false,
                message: 'Comment not celeted'
            );
            return;
        }

        $commentService = app(abstract: CommentService::class);

        $commentService->delete(comment: $comment);

        $this->toastSuccess(
            withSession: false,
            message: 'Comment deleted successfully'
        );

        UserActivityService::log(
            dto: ActivityDto::apply(
                data: [
                    'model' => $comment,
                    'type' =>  UserAcivityType::Deleted,
                    'content' =>  'Comment "' . $comment->id . '" was deleted',
                    'ip' =>  request()->ip()
                ]
            )
        );

        $this->loadComments();

        $this->dispatch(event: 'comment_created');
    }

    private function loadComments(): void
    {
        $this->comments = Comment::with('user.profile')->where(
            column: 'post_id',
            operator: $this->postId
        )
            ->latest()
            ->get();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.comments.comment-list'
        );
    }
}
