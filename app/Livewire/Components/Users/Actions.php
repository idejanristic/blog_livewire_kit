<?php

namespace App\Livewire\Components\Users;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Actions extends Component
{
    public User $user;

    public function isAllowed(array $action): bool
    {
        if (!isset($action['ability'])) {
            return true;
        }

        return Auth::user()->can(
            abilities: $action['ability']
        );
    }

    public function delete()
    {
        $this->authorize(
            ability: "user.menage"
        );

        $userRepository = app(abstract: UserRepository::class);

        $userRepository->delete(user: $this->user);

        $previous = url()->previous();

        if (str_contains(haystack: $previous, needle: "admin/users/{$this->user->id}")) {
            return $this->redirectRoute(name: 'admin.users.index', navigate: true);
        }

        return $this->redirect(url: $previous, navigate: true);
    }

    public array $actions = [
        ['name' => 'preview', 'route' => 'admin.users.show', 'title' => 'Preview', 'ability' => null, 'icon' => 'book-open'],
        ['name' => 'addAuthorRole', 'route' => 'admin.users.add.author.role', 'title' => 'Add author role', 'ability' => 'user.menage', 'icon' => 'bookmark'],
        ['name' => 'removeRequest', 'route' => 'admin.users.remove.author.request', 'title' => 'Remove request', 'ability' => 'user.menage', 'icon' => 'bookmark-slash'],
        ['name' => 'delete', 'route' => null, 'title' => 'Delete', 'ability' => 'user.menage', 'icon' => 'trash'],
    ];

    public function render(): View
    {
        return view(
            view: 'livewire.components.users.actions',
            data: [
                'actions' => $this->actions
            ]
        );
    }
}
