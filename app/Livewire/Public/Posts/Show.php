<?php

namespace App\Livewire\Public\Posts;

use App\Enums\UserAcivityType;
use App\Models\Post;
use App\Traits\UserActivitiable;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Post',
        'description' => ''
    ]
)]
class Show extends Component
{
    use UserActivitiable;

    public Post $post;

    public function mount(int $id): void
    {
        if (request()->routeIs('posts.trash')) {
            $this->post = PostRepository::findWithTrash(id: $id);
        } else {
            $this->post = PostRepository::find(id: $id);
        }
    }

    public function render(): View
    {
        $this->post->increment(column: 'view_count');

        $this->activity(
            model: $this->post,
            type: UserAcivityType::VIEWED,
            content: "Post \'{$this->post->title}\' was viewed"
        );

        return view(
            view: 'livewire.public.posts.show'
        );
    }
}
