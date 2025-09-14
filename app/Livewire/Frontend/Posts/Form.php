<?php

namespace App\Livewire\Frontend\Posts;

use App\Enums\UserAcivityType;
use App\Traits\Toastable;
use Livewire\Component;
use App\Livewire\Forms\PostForm;
use App\Models\Post;
use App\Models\Tag;
use App\Services\UserActivityService;
use Livewire\Attributes\On;

class Form extends Component
{
    use Toastable;
    public array $tags;
    public Post $post;
    public PostForm $form;

    #[On('tagsSelected')]
    public function updatedTags(array $stags = []): void
    {
        $this->form->selectedTags = array_column($stags, 'id');
    }
    public function mount(Post $post)
    {
        if ($post->exists) {
            $this->form->setPost(post: $post);
            $this->post = $post;
        }
    }

    public function update()
    {
        $this->authorize(
            ability: "update",
            arguments: $this->post
        );

        try {
            $id = $this->post->id;

            $this->form->update($this->post);

            $this->reset();

            $this->toastSuccess(
                withSession: true,
                message: 'Post edited successfully'
            );

            UserActivityService::log(
                model: $this->post,
                type: UserAcivityType::Updated,
                content: 'Post "' . $this->post->title . '" was updated',
                ip: request()->ip()
            );

            return $this->redirect(
                url: "/posts/{$id}",
                navigate: true
            );
        } catch (\Throwable $e) {

            $this->toastError(
                withSession: false,
                message: $e->getMessage()
            );


            $this->resetErrorBag();
        }
    }

    public function store()
    {
        try {
            $user_id = auth()->user()->id;

            $post = $this->form->store(user_id: $user_id);

            if (!$post) {
                $this->toastError(
                    withSession: false,
                    message: 'Post not created'
                );
                return;
            }

            $this->reset();

            $this->toastSuccess(
                withSession: true,
                message: 'Post added successfully'
            );

            UserActivityService::log(
                model: $post,
                type: UserAcivityType::Created,
                content: 'Post "' . $post->title . '" was created',
                ip: request()->ip()
            );

            return $this->redirect(
                url: '/posts/user/' . $user_id,
                navigate: true
            );
        } catch (\Throwable $e) {

            $this->toastError(
                withSession: false,
                message: $e->getMessage()
            );

            $this->resetErrorBag();
        }
    }

    public function render()
    {
        return view('livewire.frontend.posts.form');
    }
}
