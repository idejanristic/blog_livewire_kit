<?php

namespace App\Livewire\Components\Tags;

use App\Dtos\PageDto;
use App\Dtos\SortDto;
use App\Dtos\Tags\TagFilterDto;
use App\Repositories\TagRepository;
use App\Services\TagService;
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

    public int $perPage = 10;
    public string $search = '';
    public $page = 1;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function setPage($page, $pageName = 'page'): void
    {
        $this->page = $page;
    }

    public function setSortBy($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'DESC' ? 'ASC' : 'DESC';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'DESC';
        }

        // reset page after resorts
        $this->page = 1;
    }

    #[Computed]
    public function tags(): Paginator
    {
        return TagRepository::getTags(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->page,
                ]
            ),
            filters: TagFilterDto::apply(
                data: [
                    'search' => $this->search
                ]
            ),
            sortDto: SortDto::apply(
                data: [
                    'sortBy' =>  $this->sortBy,
                    'sortDir' => $this->sortDir
                ]
            )
        );
    }

    public function delete(int $id)
    {
        $tagService = app(abstract: TagService::class);

        $tag = TagRepository::find(id: $id);

        $tagService->delete(tag: $tag);

        $this->toastSuccess(
            withSession: false,
            message: 'Tag was deleted'
        );
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.tags.table',
            data: [
                'tags' => $this->tags()
            ]
        );
    }
}
