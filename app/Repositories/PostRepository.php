<?php

namespace App\Repositories;

use App\Dtos\PostDto;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

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

    public static function getFavorityPosts(int $perPage = 3): Collection
    {
        /* todo  favority flag */
        return Post::with(relations: 'user')
            ->published()
            ->take(value: $perPage)
            ->get();
    }

    /**
     * Summary of getPostsQuery
     * @param string $search
     * @return Builder<Post>
     */
    private static function getPostsQuery(string $search = '', int $userId = 0): Builder
    {
        return Post::query()
            ->with(relations: 'user')
            ->published()
            ->when(
                value: $search !== '',
                callback: function (Builder $query) use ($search): void {
                    $query->where(
                        column: 'title',
                        operator: 'like',
                        value: "%{$search}%"
                    );
                }
            )
            ->when(
                value: $userId !== 0,
                callback: function (Builder $query) use ($userId): void {
                    $query->where(column: 'user_id', operator: $userId);
                }
            )
            ->orderBy(column: 'published_at', direction: 'desc');
    }

    public static function getPublishedPosts($perPage = 6, string $search = '', int $userId = 0): Paginator
    {
        return  self::getPostsQuery(search: $search, userId: $userId)
            ->simplePaginate(perPage: $perPage);
    }

    public static function getTotalNumberPublishedPosts(string $search = '', int $userId = 0): int
    {
        return  self::getPostsQuery(search: $search,  userId: $userId)
            ->count();
    }
}
