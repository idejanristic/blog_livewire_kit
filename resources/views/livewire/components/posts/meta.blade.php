<div class='mb-2 flex items-center justify-between'>
    @if ($showUserLink)
        <flux:text>
            Posted by
            <flux:link
                :href="route('posts.user', ['id' => $post->user->id])"
                variant="subtle"
                wire:navigate
            >
                <strong class="text-orange-700 dark:text-orange-400">{{ $post->user->name }}</strong>
            </flux:link>
            @if ($post->published_at)
                on
                {{ $post->published_at->date() }}
            @endif
        </flux:text>
    @else
        <flux:text>
            @if ($post->published_at)
                Posted on {{ $post->published_at->date() }}
            @endif
        </flux:text>
    @endif
    <div class="flex items-center gap-4">
        <flux:text class="flex gap-1 font-bold text-zinc-900 dark:text-white">
            {{ $post->comments_count }}
            <x-icons.comment />
        </flux:text>

        <flux:text class="font-bold text-zinc-900 dark:text-white">
            {{ $post->view_count }} views
        </flux:text>
    </div>
</div>
