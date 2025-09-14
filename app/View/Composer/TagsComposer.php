<?php

namespace App\View\Composer;

use App\Models\Tag;
use Illuminate\View\View;

class TagsComposer
{
    public function compose(View $view): void
    {
        $view->with(
            key: 'allTags',
            value: Tag::withCount(relations: 'posts')->get()
        );

        $view->with(
            key: 'tagId',
            value: (int) request()->query(key: 'tag', default: 0)
        );
    }
}
