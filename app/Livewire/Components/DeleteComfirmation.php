<?php

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteComfirmation extends Component
{
    public string $title = '';

    public function render(): View
    {
        return view(
            view: 'livewire.components.delete-comfirmation'
        );
    }
}
