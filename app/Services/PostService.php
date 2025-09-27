<?php

namespace App\Services;

use App\Models\Post;
use App\Dtos\Posts\PostDto;
use App\Repositories\PostRepository;

use function Pest\Laravel\post;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ) {}

    /**
     * @param \App\Dtos\Posts\PostDto $dto
     * @param int $userId
     * @return Post
     */
    public function create(PostDto $dto, int $userId): Post
    {
        $post = $this->postRepository
            ->create(dto: $dto, userId: $userId);

        if ($post && count(value: $dto->tags) > 0) {
            $this->postRepository
                ->tagsSync(dto: $dto, post: $post);
        }


        return $post;
    }

    /**
     * @param \App\Dtos\Posts\PostDto $dto
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

    /**
     * @param \App\Models\Post $post
     * @return bool
     */
    public function publishe(Post $post): bool
    {
        return $post->update(
            attributes: [
                'published_at' => now()
            ]
        );
    }
}
