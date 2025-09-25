<?php

namespace App\Livewire\Admin\Users;

use App\Enums\TrashedType;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'All users',
        'description' => ''
    ]
)]
class All extends Component
{
    public string $type = TrashedType::ALL->value;

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.all'
        );
    }
}
