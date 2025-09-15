<?php

namespace App\Livewire\Frontend\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Repositories\ActivityRepostitory;
use App\Dtos\Activities\ActivityFilterDto;
use App\Dtos\SortDto;
use Illuminate\Contracts\Pagination\Paginator;

class ActivityList extends Component
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
            perPage: $this->perPage,
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

    #[Computed()]
    public function total(): int
    {
        return  ActivityRepostitory::getTotalNumberActivities(
            filters: ActivityFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'userId' => $this->user->id
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
            view: 'livewire.frontend.user.activity-list',
            data: [
                'activities' => $this->activities(),
                'total' => $this->total()
            ]
        );
    }
}
