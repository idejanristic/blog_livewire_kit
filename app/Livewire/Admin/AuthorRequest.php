<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Author request',
        'description' => ''
    ]
)]
class AuthorRequest extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.admin.author-request'
        );
    }
}
