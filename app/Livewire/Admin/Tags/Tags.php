<?php

namespace App\Livewire\Admin\Tags;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Tags',
        'description' => ''
    ]
)]
class Tags extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.admin.tags.tags'
        );
    }
}
