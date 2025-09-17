<?php

namespace App\Dtos\Posts;

use Carbon\Carbon;
use App\Enums\PostSource;

class PostDto
{
    public readonly string $title;
    public readonly string $excerpt;
    public readonly string $body;
    public readonly ?Carbon $published_at;
    public readonly PostSource $source;
    public readonly bool $status_comment;
    public readonly array $tags;

    private function __construct(
        string $title,
        string $excerpt,
        string $body,
        ?string $published_at,
        PostSource $source,
        ?bool $status_comment,
        array $tags
    ) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->published_at = $published_at ? Carbon::parse(time: $published_at) : null;
        $this->source = $source;
        $this->status_comment = $status_comment;
        $this->tags = $tags ?? [];
    }

    public static function fromAppRequest(array $data): PostDto
    {
        return new self(
            title: $data['title'],
            excerpt: $data['excerpt'],
            body: $data['body'],
            published_at: $data['published_at'] ?? null,
            source: PostSource::App,
            status_comment: $data['status_comment'] ?? false,
            tags: $data['selectedTags'] ?? []
        );
    }
}
