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

    protected int $perPage = 6;

    #[Url(as: 's', history: true)]
    public $search = '';

    #[Computed()]
    public function posts(): Paginator
    {
        return PostRepository::getPublishedPosts(
            perPage: $this->perPage,
            search: $this->search
        );
    }

    #[Computed()]
    public function total(): int
    {
        return PostRepository::getTotalNumberPublishedPosts(
            search: $this->search
        );
    }

    // resetuje paginator kad se search menja
    public function updatedSearch(): void
    {
        $this->resetPage(pageName: 'posts');
    }

    public function delete()
    {
        dd('test');
    }

    public function render(): View
    {
        return view(
            view: 'livewire.frontend.posts.post-list',
            data: [
                'posts' => $this->posts(),
                'total' => $this->total()
            ]
        );
    }
}
