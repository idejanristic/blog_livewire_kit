<?php

namespace App\View\Components\Layouts\Backend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public string $title;
    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title = 'Demo blog', string $description = '')
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.backend.app');
    }
}
