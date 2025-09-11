<?php

namespace App\Livewire\Forms;

use App\Dtos\PostDto;
use App\Models\Post;
use App\Services\PostService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    #[Validate(rule: 'required|min:3|max:255')]
    public string $title;

    #[Validate(rule: 'required|min:3|max:1024')]
    public string $excerpt;

    #[Validate(rule: 'nullable|date')]
    public ?string $published_at = null;

    #[Validate(rule: 'required|min:3|max:2048')]
    public string $body;

    public function setPost(Post $post): void
    {
        $this->title = $post->title;
        $this->excerpt = $post->excerpt;
        $this->published_at = $post->published_at ? $post->published_at->format('Y-m-d') : null;
        $this->body = $post->body;
    }

    public function store(int $user_id): Post
    {
        $validated =  $this->validate();

        $postService = app(abstract: PostService::class);

        return $postService->create(
            dto: PostDto::fromAppRequest(data: $validated),
            userId: $user_id
        );
    }

    public function update(Post $post): bool
    {
        $validated =  $this->validate();

        $postService = app(abstract: PostService::class);

        return $postService->update(
            dto: PostDto::fromAppRequest(data: $validated),
            post: $post
        );
    }
}
