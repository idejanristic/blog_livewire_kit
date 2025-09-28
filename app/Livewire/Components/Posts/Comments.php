<?php

namespace App\Livewire\Components\Posts;

use App\Repositories\CommentRepository;
use App\Services\CommentService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    protected $listeners = [
        'comment_created' => 'refreshComments',
        'comment_delete_event' => 'commentDeleted',
        'comment_like' => 'like',
        'comment_dislike' => 'dislike',
    ];

    public int $postId;

    public Collection $comments;

    public function refreshComments(): void
    {
        $this->loadComments();
    }

    public function commentDeleted(int $id): void
    {
        $comment = CommentRepository::find(id: $id);

        if (! $comment) {
            $this->toastError(
                withSession: false,
                message: 'Comment not celeted'
            );
            return;
        }

        $commentService = app(abstract: CommentService::class);

        $commentService->delete(comment: $comment);

        $this->loadComments();

        $this->dispatch(event: 'comment_created');
    }

    private function loadComments(): void
    {
        $this->comments = CommentRepository::getPostComments(postId: $this->postId);
    }

    public function like(int $id): void
    {
        // dump('usao');
        $user = Auth::user();

        if ($user && $user->exists()) {
            $comment = CommentRepository::find(id: $id);

            if (!$comment) {
                return;
            }

            $commentService = app(abstract: CommentService::class);

            $commentService->like(comment: $comment, userId: $user->id);

            $this->loadComments();
        }
    }

    public function dislike(int $id): void
    {
        $user = Auth::user();

        if ($user && $user->exists()) {
            $comment = CommentRepository::find(id: $id);

            if (!$comment) {
                return;
            }

            $commentService = app(abstract: CommentService::class);

            $commentService->dislike(comment: $comment, userId: $user->id);

            $this->loadComments();
        }
    }

    public function render(): View
    {
        return view(view: 'livewire.components.posts.comments');
    }
}
