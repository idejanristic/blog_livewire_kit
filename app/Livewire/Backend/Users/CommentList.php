<?php

namespace App\Livewire\Backend\Users;

use App\Models\User;
use App\Dtos\SortDto;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use App\Dtos\Comments\CommentFilterDto;
use App\Repositories\CommentRepository;
use Illuminate\Contracts\Pagination\Paginator;

class CommentList extends Component
{
    use WithPagination;

    public User $user;
    protected int $perPage = 10;
    public string $sortBy = 'created_at';
    public string $sortDir = 'DESC';

    #[Url(as: 's', history: true)]
    public $search = '';

    #[Computed]
    public function comments(): Paginator
    {
        return CommentRepository::getComments(
            perPage: $this->perPage,
            filters: CommentFilterDto::apply(
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
            view: 'livewire.backend.users.comment-list',
            data: [
                'comments' => $this->comments()
            ]
        );
    }
}
