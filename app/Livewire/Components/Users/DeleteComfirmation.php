<?php

namespace App\Livewire\Components\Users;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteComfirmation extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.components.users.delete-comfirmation'
        );
    }
}
