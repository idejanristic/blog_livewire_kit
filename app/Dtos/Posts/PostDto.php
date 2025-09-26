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

    private function __construct(
        string $title,
        string $excerpt,
        string $body,
        ?string $published_at,
        PostSource $source
    ) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->published_at = $published_at ? Carbon::parse(time: $published_at) : null;
        $this->source = $source;
    }

    public static function apply(array $data): PostDto
    {
        return new self(
            title: $data['title'],
            excerpt: $data['excerpt'],
            body: $data['body'],
            published_at: $data['published_at'] ?? null,
            source: PostSource::APP
        );
    }
}
