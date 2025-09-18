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

    <div class="flex items-center gap-4">
        <button type="button" class="flex gap-1 items-center space-x-2 rounded-2xl transition" wire:click="like">
            {{ $post->like_count }}
            <x-icons.like />
        </button>

        <button type="button" class="flex gap-1 items-center space-x-2 rounded-2xl transition" wire:click="dislike">
            {{ $post->dislike_count }}
            <x-icons.dislike />
        </button>

        <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
            {{ $post->comments_count }}
            <x-icons.comment />
        </flux:text>

        <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
            {{ $post->view_count }} views
        </flux:text>
    </div>
@else
    <flux:text>
        Posted on {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
    <div class="flex gap-4">
        <button type="button" class="flex items-center space-x-2 rounded-2xl transition">
            <x-icons.like />
        </button>

        <button type="button" class="flex items-center space-x-2 rounded-2xl transition">
            <x-icons.dislike />
        </button>

        <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
            {{ $post->comments_count }}
            <x-icons.comment />
        </flux:text>

        <flux:text class="dark:text-white text-zinc-900 font-bold">
            {{ $post->view_count }} views
            </flux:text>
    </div>
@endif

</div>



