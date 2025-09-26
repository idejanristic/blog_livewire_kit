@aware(['post', 'page'])

<article {{ $attributes->merge(['class' => 'mb-3 w-full']) }}>
    <div class="flex items-start justify-between">
        <flux:link
            variant="subtle"
            class="flex-1 hover:opacity-80"
            href="{{ route('posts.show', ['id' => $post->id]) }}"
            wire:navigate
        >
            <flux:heading
                size="xl"
                level="2"
            >
                {{ $post->title }}
            </flux:heading>
        </flux:link>
    </div>
    <flux:text class="mt-2">{{ $post->excerpt }}</flux:text>
</article>
