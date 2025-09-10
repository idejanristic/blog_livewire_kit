{{-- @var \App\Models\Post $post --}}
@aware(['post'])

<article wire:key="{{ $post->id }}" {{ $attributes->merge(['class' => 'mb-3']) }}>
    <flux:link variant="subtle" class="hover:opacity-80" :href="route('posts.show', ['post' => $post->id])"
        wire:navigate>
        <flux:heading size="xl" level="2">{{ $post->title }}</flux:heading>
    </flux:link>
    <flux:text class="mt-2">{{ $post->excerpt }}</flux:text>
</article>
