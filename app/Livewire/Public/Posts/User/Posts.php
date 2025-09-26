<?php

namespace App\Livewire\Public\Posts\User;

use App\Models\User;
use Livewire\Component;
use App\Enums\PublishedType;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Posts',
        'description' => 'All posts published on demo blog'
    ]
)]
class Posts extends Component
{
    public User $user;

    public function mount(int $id): void
    {
        $this->user = UserRepository::find(id: $id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.posts.user.posts',
            data: [
                'publishedType' => PublishedType::PUBLISHED->value,
                'user' => $this->user
            ]
        );
    }
}
