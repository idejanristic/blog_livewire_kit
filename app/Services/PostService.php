<?php

namespace App\Services;

use App\Dtos\PostDto;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ) {}

    /**
     * @param \App\Dtos\PostDto $dto
     * @param int $userId
     * @return Post
     */
    public function create(PostDto $dto, int $userId): Post
    {
        return $this->postRepository
            ->create(dto: $dto, userId: $userId);
    }

    /**
     * @param \App\Dtos\PostDto $dto
     * @param \App\Models\Post $post
     * @return bool
     */
    public function update(PostDto $dto, Post $post): bool
    {
        return $this->postRepository
            ->update(dto: $dto, post: $post);
    }
}
