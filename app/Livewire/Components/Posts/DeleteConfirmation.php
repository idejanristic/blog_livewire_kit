<?php

namespace App\Livewire\Components\Posts;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.components.posts.delete-confirmation'
        );
    }
}
