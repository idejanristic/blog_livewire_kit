<?php

namespace App\Livewire\Admin;

use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Dashboard',
        'description' => ''
    ]
)]
class Dashboard extends Component
{
    public int $totalUsers = 0;
    public int $onlineUsers = 0;
    public int $totalAuthorRequest = 0;

    public function mount(): void
    {
        $this->totalUsers = UserRepository::totalActiveUsers();
        $this->onlineUsers = UserRepository::totalOnlineUsers();
        $this->totalAuthorRequest = UserRepository::totalAuthorRequest();
    }

    public function render(): View
    {
        return view(
            view: 'livewire.admin.dashboard'
        );
    }
}
