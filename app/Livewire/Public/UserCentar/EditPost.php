<?php

namespace App\Livewire\Public\UserCentar;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Edit post',
        'description' => 'form form edit post'
    ]
)]
class EditPost extends Component
{
    public Post $post;

    public function mount(int $id): void
    {
        $this->post = PostRepository::find(id: $id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.user-centar.edit-post'
        );
    }
}
