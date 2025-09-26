<?php

namespace App\Livewire\Public\Posts;

use App\Enums\PublishedType;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.app',
    params: [
        'title' => 'Posts',
        'description' => 'All posts published on demo blog'
    ]
)]
class Posts extends Component
{
    public function render(): View
    {
        return view(
            view: 'livewire.public.posts.posts',
            data: [
                'publishedType' => PublishedType::PUBLISHED->value
            ]
        );
    }
}
