<?php

namespace App\Livewire\Components\Users;

use App\Models\User;
use App\Dtos\PageDto;
use App\Dtos\SortDto;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\ActivityRepostitory;
use App\Dtos\Activities\ActivityFilterDto;
use Illuminate\Contracts\Pagination\Paginator;


class Activities extends Component
{
    use WithPagination;

    public User $user;

    protected int $perPage = 10;

    #[Url(as: 's', history: true)]
    public $search = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    #[Computed()]
    public function activities(): Paginator
    {
        return ActivityRepostitory::getActivities(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage
                ]
            ),
            filters: ActivityFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'userId' => $this->user->id
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

    // resetuje paginator kad se search menja
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function setSortBy(string $column): void
    {
        if ($this->sortBy == $column) {
            $this->sortDir = ($this->sortDir == 'ASC') ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $column;
        $this->sortDir = "DESC";
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.users.activities',
            data: [
                'activities' => $this->activities()
            ]
        );
    }
}
