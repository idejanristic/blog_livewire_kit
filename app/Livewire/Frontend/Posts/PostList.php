<?php

namespace App\Livewire\Frontend\Posts;

use App\Models\Post;
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
        return Post::with(relations: 'User')
            ->latest()
            ->where(
                column: 'title',
                operator: 'like',
                value: "%{$this->search}%"
            )
            ->simplePaginate(perPage: $this->perPage);
    }

    #[Computed()]
    public function total(): int
    {
        return Post::with(relations: 'User')
            ->latest()
            ->where(
                column: 'title',
                operator: 'like',
                value: "%{$this->search}%"
            )
            ->count();
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
                'total' => $this->total()
            ]
        );
    }
}
