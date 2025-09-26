<?php

namespace App\Livewire\Public\UserCentar;

use App\Enums\PublishedType;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'User centar page',
        'description' => ''
    ]
)]
class Posts extends Component
{
    public User $user;

    public string $publishedType = PublishedType::ALL->value;

    public function mount(): void
    {
        $this->user = UserRepository::find(id: Auth::user()->id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.public.user-centar.posts',
            data: [
                'publishedType' => $this->publishedType
            ]
        );
    }
}
