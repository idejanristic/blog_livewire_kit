<?php

namespace App\Repositories;

use App\Dtos\PageDto;
use App\Dtos\SortDto;
use App\Dtos\Tags\TagDto;
use App\Dtos\Tags\TagFilterDto;
use App\Models\Tag;
use App\Repositories\Filters\Tags\SearchFilter;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class TagRepository
{
    /**
     * @param \App\Dtos\Tags\TagDto $dto
     * @return Tag
     */
    public function create(TagDto $dto)
    {
        return Tag::create(
            attributes: [
                'name' => $dto->name,
                'source' => $dto->source
            ]
        );
    }

    /**
     * @param \App\Dtos\Tags\TagDto $dto
     * @param \App\Models\Tag $tag
     * @return bool
     */
    public function update(TagDto $dto, Tag $tag)
    {
        return $tag->update(
            attributes: [
                'name' => $dto->name,
                'source' => $dto->source
            ]
        );
    }

    /**
     * @param \App\Models\Tag $tag
     * @return bool|null
     */
    public function delete(Tag $tag): bool|null
    {
        return $tag->delete();
    }

    /**
     * @param int $id
     * @return Tag|null
     */
    public static function find(int $id): Tag|null
    {
        return self::getTagRelationQuery()
            ->where(column: 'id', operator: $id)
            ->first();
    }

    public static function all(): Collection
    {
        return self::getTagRelationQuery()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Tag>
     */
    private static function getTagRelationQuery()
    {
        return Tag::query()
            ->withCount(relations: [
                'posts' => fn($q) => $q->published()
            ]);
    }

    private static function getTagsQuery(TagFilterDto $filters, ?SortDto $sortDto = null)
    {
        if ($filters === null) {
            $filters = new TagFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return self::getTagRelationQuery()
            ->tap(callback: new SearchFilter(search: $filters->search))
            ->orderBy(column: $sortDto->sortBy, direction: $sortDto->sortDir)
            ->orderBy(column: 'id', direction: $sortDto->sortDir);
    }

    public static function getTags(
        PageDto $pageDto,
        TagFilterDto $filters,
        ?SortDto $sortDto = null
    ): Paginator {
        if ($filters === null) {
            $filters = new TagFilterDto();
        }

        if ($sortDto === null) {
            $sortDto = new SortDto();
        }

        return  self::getTagsQuery(filters: $filters, sortDto: $sortDto)
            ->paginate(
                perPage: $pageDto->perPage,
                columns: $pageDto->columns,
                pageName: $pageDto->pageName,
                page: $pageDto->page
            );
    }
}
