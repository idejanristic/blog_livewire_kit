<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class TagService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTags(): Collection
    {
        return Cache::remember(
            key: 'tags_with_posts_count',
            ttl: 3600, // 1h cache
            callback: fn() => Tag::withCount('posts')->get()
        );
    }
}
