<?php

namespace App\Livewire\Admin\Users;

use App\Enums\TrashedType;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Users',
        'description' => ''
    ]
)]
class Index extends Component
{
    public string $type = TrashedType::UNTRASHED->value;

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.all'
        );
    }
}
