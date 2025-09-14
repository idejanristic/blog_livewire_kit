<?php

namespace App\Services;

use App\Models\Post;
use App\Dtos\PostDto;
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
        $post =  $this->postRepository
            ->create(dto: $dto, userId: $userId);

        if ($post && count(value: $dto->tags) > 0) {
            $this->postRepository
                ->tagsSync(dto: $dto, post: $post);
        }

        return $post;
    }

    /**
     * @param \App\Dtos\PostDto $dto
     * @param \App\Models\Post $post
     * @return bool
     */
    public function update(PostDto $dto, Post $post): bool
    {
        $status =  $this->postRepository
            ->update(dto: $dto, post: $post);

        if ($status && count(value: $dto->tags) > 0) {
            $this->postRepository
                ->tagsSync(dto: $dto, post: $post);
        }

        return $status;
    }
}
