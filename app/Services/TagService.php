<?php

namespace App\Services;

use App\Dtos\Tags\TagDto;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
    public function __construct(
        private TagRepository $tagRepository
    ) {}

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTags(): Collection
    {
        return $this->tagRepository->all();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory(count: 10)->create();
    }

    /**
     * @param \App\Dtos\Tags\TagDto $dto
     * @return Tag
     */
    public function create(TagDto $dto): Tag
    {
        return $this->tagRepository
            ->create(dto: $dto);
    }

    /**
     * @param \App\Models\Tag $tag
     * @return bool|null
     */
    public function delete(Tag $tag): bool|null
    {
        return $this->tagRepository->delete(tag: $tag);
    }
}
