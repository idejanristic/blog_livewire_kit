<?php

namespace App\Livewire\Frontend\Posts;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

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
            search: $this->search,
            tagId: $this->tag
        );
    }

    #[Computed()]
    public function total(): int
    {
        return PostRepository::getTotalNumberPublishedPosts(
            search: $this->search,
            tagId: $this->tag
        );
    }

    // resetuje paginator kad se search menja
    public function updatedSearch(): void
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
