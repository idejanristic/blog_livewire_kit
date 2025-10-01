<?php

namespace App\Livewire\Admin\Posts;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Trashed Posts',
        'description' => ''
    ]
)]
class Trash extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.admin.posts.trash'
        );
    }
}
