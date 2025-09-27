<?php

namespace App\Livewire\Components\Tags;

use App\Dtos\Tags\TagDto;
use App\Enums\TagSource;
use App\Services\TagService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewTag extends Component
{
    #[Validate(rule: 'required|min:3|max:55')]
    public string $name;

    public function createTag()
    {
        $this->authorize(ability: 'create.tag');

        $validated = $this->validate();
        $validated['source'] = TagSource::APP;

        $tagService = app(abstract: TagService::class);

        $tagService->create(
            dto: TagDto::apply(data: $validated)
        );

        $this->reset();

        $this->redirectRoute(
            name: 'admin.tags.index',
            navigate: true
        );
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.tags.new-tag'
        );
    }
}
