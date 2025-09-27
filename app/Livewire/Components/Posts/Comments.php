<?php

namespace App\Livewire\Components\Posts;

use App\Repositories\CommentRepository;
use App\Services\CommentService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Comments extends Component
{
    protected $listeners = [
        'comment_created' => 'refreshComments',
        'comment_delete_event' => 'commentDeleted'
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

    public function render(): View
    {
        return view(view: 'livewire.components.posts.comments');
    }
}
