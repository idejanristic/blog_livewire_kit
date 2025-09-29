<?php

namespace App\Livewire\Components\Comments;

use App\Dtos\Comments\CommentFilterDto;
use App\Dtos\PageDto;
use App\Dtos\SortDto;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
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

    #[Computed()]
    public function comments(): Paginator
    {
        return CommentRepository::getComments(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->page,
                ]
            ),
            filters: CommentFilterDto::apply(
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
        $commentService = app(abstract: CommentService::class);

        $comment = CommentRepository::find(id: $id);

        $commentService->delete(comment: $comment);

        $this->toastSuccess(
            withSession: false,
            message: 'Comment was deleted'
        );
    }


    public function render(): View
    {
        return view(
            view: 'livewire.components.comments.table',
            data: [
                'comments' => $this->comments()
            ]
        );
    }
}
