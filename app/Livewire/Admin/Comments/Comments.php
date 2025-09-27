<?php

namespace App\Livewire\Admin\Comments;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Comments',
        'description' => ''
    ]
)]
class Comments extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.admin.comments.comments'
        );
    }
}
