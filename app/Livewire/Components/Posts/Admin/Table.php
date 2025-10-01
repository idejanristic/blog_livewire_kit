<?php

namespace App\Livewire\Components\Posts\Admin;

use App\Dtos\PageDto;
use App\Dtos\Posts\PostFilterDto;
use App\Dtos\SortDto;
use App\Enums\TrashedType;
use App\Repositories\PostRepository;
use App\Services\PostService;
use App\Traits\Toastable;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, Toastable;
    protected $queryString = [];
    public TrashedType $type = TrashedType::TRASHED;

    public int $perPage = 10;
    public string $search = '';
    public $page = 1;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function mount(string $trashedType): void
    {
        $this->type = TrashedType::tryFrom(value: $trashedType);
    }

    public function setPage($page, $pageName = 'page'): void
    {
        $this->page = $page;
    }

    public function setSortBy($column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'DESC' ? 'ASC' : 'DESC';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'DESC';
        }

        $this->page = 1;
    }

    #[Computed()]
    public function posts(): Paginator
    {
        return PostRepository::getPosts(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->page,
                ]
            ),
            filters: PostFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'trashedType' => $this->type,
                ]
            ),
            sortDto: SortDto::apply(data: [
                'sortBy' => $this->sortBy,
                'sortDir' =>  $this->sortDir
            ])
        );
    }

    public function delete(int $id)
    {
        $postService = app(abstract: PostService::class);

        $post = PostRepository::find(id: $id);

        if ($post) {
            $postService->delete($post);

            $previous = url()->previous();

            $this->toastSuccess(
                withSession: true,
                message: 'Post was deleted successfully'
            );

            return $this->redirect(
                url: $previous,
                navigate: true
            );
        }
    }

    public function restore(int $id)
    {
        $postService = app(abstract: PostService::class);

        $post = PostRepository::findWithTrash(id: $id);

        if ($post) {
            $postService->restore($post);

            $previous = url()->previous();

            $this->toastSuccess(
                withSession: true,
                message: 'Post was restore successfully'
            );

            return $this->redirect(
                url: $previous,
                navigate: true
            );
        }
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.posts.admin.table',
            data: [
                'posts' => $this->posts
            ]
        );
    }
}
