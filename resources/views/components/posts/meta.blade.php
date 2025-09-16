{{-- @var \App\Models\Post $post --}}
@aware(['post', 'showUserLink' => false])

@if($showUserLink)
    <div {{ $attributes->merge(['class' => 'flex justify-between mb-2']) }}>
        <flux:text>
            Posted by <flux:link :href="route('posts.user', ['user' => $post->user->id])" variant="subtle" wire:navigate>
                <strong class="dark:text-orange-400 text-orange-700">{{ $post->user->profile_title}}
                    {{ $post->user->profile_name }}</strong>
            </flux:link> on
            {{ $post->published_at->toFormattedDateString() }}
        </flux:text>
        <flux:text class="dark:text-white text-zinc-900 font-bold">
            {{ $post->view_count }} views
        </flux:text>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'flex justify-between mb-2']) }}>
        <flux:text {{ $attributes->merge(['class' => 'mb-2']) }}>
            Posted on {{ $post->published_at->toFormattedDateString() }}
        </flux:text>
        <flux:text class="dark:text-white text-zinc-900 font-bold">
            {{ $post->view_count }} views
        </flux:text>
    </div>
@endif


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