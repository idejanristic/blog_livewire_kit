<?php

namespace App\View\Composer;

use App\Models\Tag;
use Illuminate\View\View;
use App\Services\TagService;
use Illuminate\Support\Facades\Cache;

class TagsComposer
{
    public function __construct(
        protected TagService $tagService
    ) {}

    public function compose(View $view): void
    {
        $tags = Cache::remember(
            key: 'tags_with_posts_count',
            ttl: 3600, // 1 h, with null for indefinite
            callback: fn() => Tag::withCount('posts')->get()
        );

        $view->with(
            key: 'allTags',
            value: $tags
        );

        $view->with(
            key: 'tagId',
            value: (int) request()->query(key: 'tag', default: 0)
        );
    }
}
