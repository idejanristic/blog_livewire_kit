<?php

namespace App\Livewire\Components\Posts;

use App\Livewire\Forms\PostForm;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\Toastable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    use Toastable;
    public array $tags = [];

    public Post $post;

    public PostForm $form;

    #[On('tagsSelected')]
    public function updatedTags(array $stags = []): void
    {
        $this->form->selectedTags = array_column($stags, 'id');
    }

    public function mount(Post $post): void
    {
        if ($post->exists) {
            $this->form->setPost(post: $post);
            $this->post = $post;
        }

        $this->tags = Tag::select(['id', 'name'])->get()->toArray();
    }

    public function store()
    {
        try {
            $user_id = Auth::user()->id;

            $post = $this->form->store(user_id: $user_id);

            if (!$post) {
                $this->toastError(
                    withSession: false,
                    message: 'Oops! Something went wrong',
                );

                return;
            }

            $this->toastSuccess(
                withSession: true,
                message: 'Post was created successfully'
            );

            return $this->redirectRoute(
                name: 'user.center.index',
                navigate: true
            );
        } catch (\Throwable $e) {
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
            );

            $this->resetErrorBag();
        }
    }

    public function update()
    {
        $this->authorize(
            ability: "update",
            arguments: $this->post
        );

        try {
            $post = $this->post;

            $this->form->update(post: $post);

            $this->reset();

            $this->toastSuccess(
                withSession: true,
                message: 'Post was updated successfully'
            );

            return $this->redirectRoute(
                name: 'user.posts.edit',
                parameters: ['id' => $post->id],
                navigate: true
            );
        } catch (\Throwable $e) {
            $this->toastError(
                withSession: false,
                message: 'Oops! Something went wrong',
            );

            $this->resetErrorBag();
        }
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.posts.form',
            data: [
                'tags' => $this->tags
            ]
        );
    }
}
