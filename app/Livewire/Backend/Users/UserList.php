<?php

namespace App\Livewire\Backend\Users;

use App\Dtos\SortDto;
use App\Dtos\Users\UserFilterDto;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    protected int $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    #[Url(as: 's', history: true)]
    public $search = '';

    #[Computed]
    public function users(): LengthAwarePaginator
    {
        return UserRepository::getUsers(
            perPage: $this->perPage,
            filters: UserFilterDto::apply(
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
            view: 'livewire.backend.users.user-list',
            data: [
                'users' => $this->users()
            ]
        );
    }
}
