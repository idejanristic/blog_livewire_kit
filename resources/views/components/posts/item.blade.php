{{-- @var \App\Models\Post $post --}}
@aware(['post', 'page'])

<article {{ $attributes->merge(['class' => 'mb-3 w-full']) }}>
    <div class="flex justify-between items-start">
        <flux:link variant="subtle" class="hover:opacity-80 flex-1" :href="route('posts.show', ['post' => $post->id])"
            wire:navigate>
            <flux:heading size="xl" level="2">
                {{ $post->title }}
            </flux:heading>
        </flux:link>
        @auth
            @livewire('frontend.posts.actions', ['post' => $post], key('post_actions_' . $post->id . '_page_' . $page))
        @endauth
    </div>
    <flux:text class="mt-2">{{ $post->excerpt }}</flux:text>
</article>
