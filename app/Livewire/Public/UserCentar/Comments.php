<?php

namespace App\Livewire\Public\UserCentar;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'User centar',
        'description' => ''
    ]
)]
class Comments extends Component
{
    public User $user;

    public function mount(): void
    {
        $this->user = UserRepository::find(id: Auth::user()->id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.user-centar.comments'
        );
    }
}
