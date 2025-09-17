@props([
    'attributes' => new \Illuminate\View\ComponentAttributeBag
])

<div {{ $attributes->merge(['class' => 'flex justify-between mb-2']) }}>
@if($showUserLink)
    <flux:text>
        Posted by <flux:link :href="route('posts.user', ['user' => $post->user->id])" variant="subtle" wire:navigate>
            <strong class="dark:text-orange-400 text-orange-700">{{ $post->user->profile_title}}
                {{ $post->user->profile_name }}</strong>
        </flux:link> on
        {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
    <div class="flex gap-4">
        <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
            {{ $post->comments_count }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
        </flux:text>
        <flux:text class="dark:text-white text-zinc-900 font-bold">
            {{ $post->view_count }} views
        </flux:text>
    </div>
@else
    <flux:text>
        Posted on {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
    <div class="flex gap-4">
        <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
            {{ $post->comments_count }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
        </flux:text>
        <flux:text class="dark:text-white text-zinc-900 font-bold">
            {{ $post->view_count }} views
        </flux:text>
    </div>
@endif
</div>


{{-- <span class="article-meta-view"><i class="fa fa-eye" aria-hidden="true"></i> <span>{{ $article->view_count
        }}</span>
    views</span>
@if($article->status_comment)
<span class="article-meta-comments"><i class="fa fa-comments-o" aria-hidden="true"></i>
    <span>{{ $article->comment_count }}</span> comments</span>
@endif
<span class="article-meta-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
    <span>{{ $article->like_count }}</span> </span>
<span class="article-meta-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
    <span>{{ $article->dislike_count }}</span> </span> --}}
