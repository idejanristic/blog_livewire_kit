<?php

namespace  App\Livewire\Frontend\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.frontend.app',
    params: [
        'title' => 'Appearance',
        'description' => ''
    ]
)]
class Appearance extends Component {}
