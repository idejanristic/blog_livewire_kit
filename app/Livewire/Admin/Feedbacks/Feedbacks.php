<?php

namespace App\Livewire\Admin\Feedbacks;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Feedbacks',
        'description' => ''
    ]
)]
class Feedbacks extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.admin.feedbacks.feedbacks'
        );
    }
}
