<?php

namespace App\Livewire\Public\UserCentar;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'User centar',
        'description' => ''
    ]
)]
class Activities extends Component
{
    public User $user;

    public function mount(): void
    {
        $this->user = UserRepository::find(id: Auth::user()->id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.user-centar.activities'
        );
    }
}
