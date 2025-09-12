<?php

namespace App\Livewire\Frontend\Posts;

use Livewire\Component;
use App\Dtos\PostFilterDto;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;

class PostList extends Component
{
    use WithPagination;

    #[Url(as: 'tag', history: true)]
    public int $tag = 0;

    protected $queryString = ['tag'];

    protected int $perPage = 6;

    #[Url(as: 's', history: true)]
    public $search = '';

    public function mount(): void
    {
        // $tag = request()->query(key: 'tag');
    }

    #[Computed()]
    public function posts(): Paginator
    {
        return PostRepository::getPublishedPosts(
            perPage: $this->perPage,
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'tagId' => $this->tag
                ]
            )
        );
    }

    #[Computed()]
    public function total(): int
    {
        return PostRepository::getTotalNumberPublishedPosts(
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'tagId' => $this->tag
                ]
            )
        );
    }

    // resetuje paginator kad se search menja
    public function updatedSearch(): void
    {
        $this->resetPage(pageName: 'posts');
    }

    // resetuje paginator kad se tag menja
    public function updatedTag(): void
    {
        $this->resetPage(pageName: 'posts');
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.post-list',
            data: [
                'posts' => $this->posts(),
                'total' => $this->total(),
                'tagId' => $this->tag
            ]
        );
    }
}
