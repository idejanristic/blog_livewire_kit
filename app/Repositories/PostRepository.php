<?php

namespace App\Repositories;

use App\Dtos\PageDto;
use App\Dtos\Posts\PostDto;
use App\Dtos\Posts\PostFilterDto;
use App\Dtos\SortDto;
use App\Models\Post;
use App\Repositories\Filters\Posts\PublishedFilter;
use App\Repositories\Filters\Posts\SearchFilter;
use App\Repositories\Filters\Tags\TagFilter;
use App\Repositories\Filters\UserFilter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    /**
     * @param \App\Dtos\Posts\PostDto $dto
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
     * @param \App\Dtos\Posts\PostDto $dto
     * @param \App\Models\Post $post
     * @return bool
     */
    public function update(PostDto $dto, Post $post): bool
    {
        return $post->update(
            attributes: [
                'title' => $dto->title,
                'excerpt' => $dto->excerpt,
                'body' => $dto->body,
                'published_at' => $dto->published_at
            ]
        );
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
     * @param \App\Dtos\Posts\PostDto $dto
     * @param \App\Models\Post $post
     * @return void
     */
    public function tagsSync(PostDto $dto, Post $post): void
    {
        $post->tags()->sync(ids: $dto->tags);
    }

    /**
     * @param int $id
     * @return Post|null
     */
    public static function find(int $id): Post|null
    {
        return self::getPostRelationQuery()
            ->where(column: 'id', operator: $id)
            ->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Post>
     */
    private static function getPostRelationQuery()
    {
        return Post::query()
            ->with(relations: [
                'user.roles',
                'user.sessions',
                'tags' => fn($query): mixed => $query->withCount('posts')
            ]);
    }

    /**
     * @param \App\Dtos\Posts\PostFilterDto $filters
     * @return \Illuminate\Database\Eloquent\Builder<Post>
     */
    private static function getPostsQuery(PostFilterDto $filters, ?SortDto $sortDto = null)
    {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getPostRelationQuery()
            ->tap(callback: new PublishedFilter(publishedType: $filters->publishedType))
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->tap(callback: new UserFilter(userId: $filters->userId))
            ->tap(callback: new TagFilter(tagId: $filters->tagId))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir)
            ->orderBy(column: 'id', direction: $sortDto->sortDir);
    }

    /**
     * @param mixed $perPage
     * @param \App\Dtos\Posts\PostFilterDto $filters
     * @return Paginator
     */
    public static function getPostsSimple(PageDto $pageDto, PostFilterDto $filters, SortDto $sortDto): Paginator
    {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return  self::getPostsQuery(filters: $filters, sortDto: $sortDto)
            ->simplePaginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }

    /**
     * @param \App\Dtos\Posts\PostFilterDto $filters
     * @return int
     */
    public static function getTotalNumberPosts(PostFilterDto $filters): int
    {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        return self::getPostsQuery(filters: $filters)
            ->count();
    }

    /**
     * @param int $perPage
     * @param \App\Dtos\Posts\PostFilterDto $filters
     * @return Paginator
     */
    public static function getPosts(
        PageDto $pageDto,
        PostFilterDto $filters,
        ?SortDto $sortDto = null
    ): Paginator {
        if ($filters === null) {
            $filters = new PostFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return  self::getPostsQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }

    /**
     * @param int $perPage
     * @return Collection<int, Post>
     */
    public static function getMostViewPosts(int $perPage = 3): Collection
    {
        return self::getPostRelationQuery()
            ->published()
            ->orderBy(column: 'view_count', direction: 'desc')
            ->take(value: $perPage)
            ->get();
    }
}
