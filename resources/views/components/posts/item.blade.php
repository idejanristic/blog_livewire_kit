{{-- @var \App\Models\Post $post --}}
@props(['post'])

<article wire:key="{{ $post->id }}" class="mb-8">
    <flux:link variant="subtle" class="hover:opacity-80" :href="route('posts.show', ['post' => $post->id])"
        wire:navigate>
        <flux:heading size="xl" level="2">{{ $post->title }}</flux:heading>
    </flux:link>
    <flux:text class="mt-2">{{ $post->excerpt }}</flux:text>
    <x-posts.meta :post="$post" />
</article>
