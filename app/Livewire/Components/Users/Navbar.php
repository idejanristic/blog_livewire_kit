<?php

namespace App\Livewire\Components\Users;

use App\Enums\TrashedType;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Navbar extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.components.users.navbar',
            data: [
                'data' => TrashedType::cases()
            ]
        );
    }
}
