<?php

namespace App\Livewire\Frontend\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Dtos\Posts\PostFilterDto;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;

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
        return PostRepository::getPosts(
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
            view: 'livewire.frontend.user.post-list',
            data: [
                'posts' => $this->posts(),
                'total' => $this->total()
            ]
        );
    }
}
