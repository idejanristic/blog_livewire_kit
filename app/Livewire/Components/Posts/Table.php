<?php

namespace App\Livewire\Components\Posts;

use App\Models\User;
use App\Dtos\PageDto;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Dtos\Posts\PostFilterDto;
use App\Dtos\SortDto;
use App\Enums\PublishedType;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;

class Table extends Component
{
    use WithPagination;

    public ?User $user = null;
    protected int $perPage = 6;
    #[Url(as: 's', history: true)]
    public $search = '';
    public string $publishedType = 'published';
    public bool $showTabs = false;

    public function mount(string $publishedType): void
    {
        $this->publishedType = $publishedType;
    }

    public function setPublishedType(string $publishedType): void
    {
        $this->publishedType = $publishedType;
        $this->search = '';
        $this->resetPage();
    }

    #[Computed]
    public function posts(): Paginator
    {
        return PostRepository::getPostsSimple(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->getPage(),
                ]
            ),
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'userId' => $this->user->id ?? null,
                    'publishedType' => PublishedType::tryFrom(
                        value: $this->publishedType
                    )
                ]
            ),
            sortDto: SortDto::apply(data: [
                'sortBy' => 'published_at',
                'sortDir' => 'desc'
            ])
        );
    }

    #[Computed]
    public function total(): int
    {
        return PostRepository::getTotalNumberPosts(
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'userId' => $this->user->id ?? null,
                    'publishedType' => PublishedType::tryFrom(
                        value: $this->publishedType
                    )
                ]
            )
        );
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.posts.table',
            data: [
                'posts' => $this->posts(),
                'total' => $this->total()
            ]
        );
    }
}
