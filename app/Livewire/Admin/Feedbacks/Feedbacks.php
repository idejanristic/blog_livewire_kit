<?php

namespace App\Livewire\Admin\Feedbacks;

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
    public function render()
    {
        return view('livewire.admin.feedbacks.feedbacks');
    }
}
