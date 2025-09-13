<?php

namespace App\Livewire\Frontend\Posts;

use App\Traits\Toastable;
use Livewire\Component;
use App\Livewire\Forms\PostForm;
use App\Models\Post;

class Form extends Component
{
    use Toastable;

    public Post $post;
    public PostForm $form;

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
