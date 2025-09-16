<?php

namespace App\View\Composer;

use App\Services\TagService;
use Illuminate\View\View;

class TagsComposer
{
    public function __construct(
        protected TagService $tagService
    ) {}

    public function compose(View $view): void
    {
        $view->with(
            key: 'allTags',
            value: $this->tagService->getAllTags()
        );

        $view->with(
            key: 'tagId',
            value: (int) request()->query(key: 'tag', default: 0)
        );
    }
}
