<?php

namespace  App\Livewire\Frontend\Posts\User;

use App\Dtos\Posts\PostFilterDto;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    public User $user;

    use WithPagination;

    protected int $perPage = 6;

    #[Url(as: 's', history: true)]
    public $search = '';

    #[Computed()]
    public function posts(): Paginator
    {
        return PostRepository::getPublishedPosts(
            perPage: $this->perPage,
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'userId' => $this->user->id
                ]
            )
        );
    }

    #[Computed()]
    public function total(): int
    {
        return PostRepository::getTotalNumberPosts(
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'userId' => $this->user->id
                ]
            )
        );
    }

    // resetuje paginator kad se search menja
    public function updatedSearch(): void
    {
        $this->resetPage();
    }


    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.user.post-list',
            data: [
                'posts' => $this->posts(),
                'total' => $this->total()
            ]
        );
    }
}
