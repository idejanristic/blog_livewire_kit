<?php

namespace App\Livewire\Components\Users\Roles;

use App\Dtos\PageDto;
use App\Dtos\Roles\RoleDto;
use App\Dtos\Roles\RoleFilterDto;
use App\Dtos\SortDto;
use App\Repositories\RoleRepository;
use App\Services\RoleService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    protected $queryString = [];

    public int $perPage = 10;
    public string $search = '';
    public $page = 1;
    public $sortBy = 'created_at';
    public $sortDir = 'ASC';

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
    public function roles(): Paginator
    {
        return RoleRepository::getRoles(
            pageDto: PageDto::apply(
                data: [
                    'perPage' => $this->perPage,
                    'page' => $this->page,
                ]
            ),
            filters: RoleFilterDto::apply(
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
        $role = RoleRepository::find($id);

        if ($role) {
            $roleService = app(abstract: RoleService::class);
            $roleService->delete($role);
        }
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.users.roles.table',
            data: [
                'roles' => $this->roles()
            ]
        );
    }
}
