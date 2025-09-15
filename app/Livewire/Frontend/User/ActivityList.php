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
use Illuminate\Contracts\Pagination\Paginator;

class ActivityList extends Component
{
    use WithPagination;

    public User $user;

    protected int $perPage = 10;

    #[Url(as: 's', history: true)]
    public $search = '';

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
