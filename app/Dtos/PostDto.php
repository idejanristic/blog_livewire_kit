<?php

namespace App\Dtos;

use App\Enums\PostSource;
use Carbon\Carbon;

class PostDto
{
    public readonly string $title;
    public readonly string $excerpt;
    public readonly string $body;
    public readonly Carbon $published_at;
    public readonly PostSource $source;

    private function __construct(
        string $title,
        string $excerpt,
        string $body,
        string $published_at,
        PostSource $source
    ) {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->published_at = Carbon::parse($published_at);
        $this->source = $source;
    }

    public static function fromAppRequest(array $data): PostDto
    {
        return new self(
            title: $data['title'],
            excerpt: $data['excerpt'],
            body: $data['body'],
            published_at: $data['published_at'] ?? null,
            source: PostSource::App
        );
    }
}
