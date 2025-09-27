<?php

namespace App\Livewire\Components\Feedbacks;

use App\Dtos\PageDto;
use App\Dtos\SortDto;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Repositories\FeedbackRepository;
use App\Dtos\Feedbacks\FeedbackFilterDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Table extends Component
{
    use WithPagination;

    protected $queryString = [];

    public string $search = '';
    public $page = 1;
    public int $perPage = 10;
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

        $this->page = 1;
    }

    #[Computed]
    public function feedbacks(): LengthAwarePaginator
    {
        return FeedbackRepository::getFeedbacks(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->page,
                ]
            ),
            filters: FeedbackFilterDto::apply(data: [
                'search' => $this->search,
                // 'userId' => Auth::user()->id ?? null
            ]),
            sortDto: SortDto::apply(
                data: [
                    'sortBy' =>  $this->sortBy,
                    'sortDir' => $this->sortDir
                ]
            )
        );
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.feedbacks.table',
            data: [
                'feedbacks' => $this->feedbacks()
            ]
        );
    }
}
