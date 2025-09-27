<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagService
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTags(): Collection
    {
        return Tag::withCount(relations: [
            'posts' => function ($query): void {
                $query->published();
            }
        ])->get();
    }
}
