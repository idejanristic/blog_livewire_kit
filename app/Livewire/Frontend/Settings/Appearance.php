<?php

namespace  App\Livewire\Frontend\Settings;

use App\Services\TagService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.frontend.app',
    params: [
        'title' => 'Appearance',
        'description' => ''
    ]
)]
class Appearance extends Component
{
    public $allTags = [];
    public int $tagId = 0;

    /**
     * Mount the component.
     */
    public function mount(TagService $tagService): void
    {
        $this->allTags = $tagService->getAllTags();
        $this->tagId = (int) request()->query('tag', 0);
    }
}
