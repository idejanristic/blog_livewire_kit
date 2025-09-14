<?php

namespace App\Repositories;

use App\Models\Post;
use App\Dtos\PostDto;
use App\Dtos\PostFilterDto;
use App\Repositories\Filters\TagFilter;
use App\Repositories\Filters\UserFilter;
use App\Repositories\Filters\SearchFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;

class PostRepository
{

    /**
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

    /**
     * @param \App\Dtos\PostDto $dto
     * @param \App\Models\Post $post
     * @return bool
     */
    public function update(PostDto $dto, Post $post): bool
    {
        return $post->update([
            'title' => $dto->title,
            'excerpt' => $dto->excerpt,
            'body' => $dto->body,
            'published_at' => $dto->published_at
        ]);
    }

    /**
     * @param \App\Models\Post $post
     * @return bool|null
     */
    public function delete(Post $post): bool|null
    {
        return $post->delete();
    }

    /**
     * @param \App\Dtos\PostDto $dto
     * @param \App\Models\Post $post
     * @return void
     */
    public function tagsSync(PostDto $dto, Post $post): void
    {
        $post->tags()->sync(ids: $dto->tags);
    }

    /**
     * @param int $perPage
     * @return Collection<int, Post>
     */
    public static function getFavorityPosts(int $perPage = 3): Collection
    {
        /* todo  favority flag */
        return Post::with(relations: [
            'user',
            'tags' => function ($query): void {
                $query->withCount('posts');
            }
        ])
            ->published()
            ->take(value: $perPage)
            ->get();
    }

    /**
     * Summary of getPostsQuery
     * @param string $search
     */
    private static function getPostsQuery(PostFilterDto $filters)
    {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        return Post::query()
            ->with(relations: [
                'user',
                'tags' => function ($query): void {
                    $query->withCount('posts');
                }
            ])
            ->published()
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new UserFilter(userId: $filters->userId))
            ->tap(callback: new TagFilter(tagId: $filters->tagId))
            ->orderBy(column: 'published_at', direction: 'desc');
    }

    /**
     * @param mixed $perPage
     * @param \App\Dtos\PostFilterDto $filters
     * @return Paginator
     */
    public static function getPublishedPosts($perPage = 6, PostFilterDto $filters): Paginator
    {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        return  self::getPostsQuery(filters: $filters)
            ->simplePaginate(perPage: $perPage);
    }

    /**
     * @param \App\Dtos\PostFilterDto $filters
     * @return int
     */
    public static function getTotalNumberPublishedPosts(PostFilterDto $filters): int
    {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        return  self::getPostsQuery(filters: $filters)
            ->count();
    }
}
