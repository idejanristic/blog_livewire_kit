<?php

namespace App\Livewire\Frontend\Posts;

use Livewire\Component;
use App\Livewire\Forms\PostForm;
use App\Models\Post;

class Form extends Component
{
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
        $id = $this->post->id;

        $this->form->update($this->post);

        $this->reset();

        return $this->redirect(
            url: "/posts/{$id}",
            navigate: true
        );
    }

    public function store()
    {
        $user_id = auth()->user()->id;

        $post = $this->form->store(user_id: $user_id);

        $this->reset();

        return $this->redirect(
            url: '/posts/user/' . $user_id,
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.frontend.posts.form');
    }
}
