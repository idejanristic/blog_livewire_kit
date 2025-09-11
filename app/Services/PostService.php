<?php

namespace App\Services;

use App\Dtos\PostDto;
use App\Models\Post;

class PostService
{
    /**
     *
     * @param \App\Dtos\PostDto $dto
     * @param int $userId
     * @return Post
     */
    public function create(PostDto $dto, int $userId): Post
    {
        return Post::create(
            attributes: [
                'title' => $dto->title,
                'excerpt' => $dto->excerpt,
                'body' => $dto->body,
                'source' => $dto->source,
                'published_at' => $dto->published_at,
                'user_id' => $userId
            ]
        );
    }

    public function update(PostDto $dto, Post $post): bool
    {
        return $post->update([
            'title' => $dto->title,
            'excerpt' => $dto->excerpt,
            'body' => $dto->body,
            'published_at' => $dto->published_at
        ]);
    }
}
