<?php

namespace App\Livewire\Components\Users;

use App\Dtos\PageDto;
use App\Dtos\SortDto;
use Livewire\Component;
use Livewire\WithPagination;
use App\Dtos\Users\UserFilterDto;
use App\Enums\TrashedType;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;

class Table extends Component
{
    use WithPagination;

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

    public function setPage($page, $pageName = 'page')
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
    public function users(): LengthAwarePaginator
    {
        return UserRepository::getUsers(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->page,
                ]
            ),
            filters: UserFilterDto::apply(
                data: [
                    'search' => $this->search,
                    'trashedType' => $this->type
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

    public function deleteItem(int $id)
    {
        $user = UserRepository::find(id: $id);

        $userService = app(abstract: UserService::class);

        $userService->delete(user: $user);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.users.table',
            data: [
                'users' => $this->users()
            ]
        );
    }
}
