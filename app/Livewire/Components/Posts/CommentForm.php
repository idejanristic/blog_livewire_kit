<?php

namespace App\Livewire\Components\Posts;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Services\CommentService;
use App\Dtos\Comments\CommentDto;
use App\Repositories\UserRepository;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CommentForm extends Component
{
    public ?User $user = null;

    public ?Post $post = null;

    #[Validate(rule: 'required|string|min:3|max:1024', as: 'comment')]
    public string $body = '';

    public function mount()
    {
        $this->user = UserRepository::find(id: Auth::user()->id);
    }

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
            return;
        }

        $this->dispatch(event: 'comment_created');

        $this->reset('body');
    }

    public function render()
    {
        return view('livewire.components.posts.comment-form');
    }
}
