<?php

namespace App\Livewire\Frontend\User;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

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
        return UserActivity::where(
            column: 'user_id',
            operator: $this->user->id
        )
            ->latest()
            ->paginate(
                perPage: $this->perPage
            );
    }

    #[Computed()]
    public function total(): int
    {
        return UserActivity::where(
            column: 'user_id',
            operator: $this->user->id
        )->count();
    }

    // resetuje paginator kad se search menja
    public function updatedSearch(): void
    {
        $this->resetPage(pageName: 'activities');
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
