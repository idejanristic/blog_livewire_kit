<?php

namespace App\Livewire\Admin\Users;

use App\Enums\TrashedType;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Treshed users',
        'description' => ''
    ]
)]
class Treshed extends Component
{
    public string $type = TrashedType::TRASHED->value;

    public function render(): View
    {
        return view(
            view: 'livewire.admin.users.all',
        );
    }
}
