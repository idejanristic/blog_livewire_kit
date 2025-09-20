<?php

namespace App\Livewire\Backend\Users;

use App\Dtos\Posts\PostFilterDto;
use App\Dtos\SortDto;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public User $user;
    protected int $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    #[Url(as: 's', history: true)]
    public $search = '';

    #[Computed]
    public function posts(): Paginator
    {
        return PostRepository::getPostsAlt(
            perPage: $this->perPage,
            filters: PostFilterDto::apply(
                data: [
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

    public function render()
    {
        return view('livewire.backend.users.post-list', [
            'posts' => $this->posts()
        ]);
    }
}
