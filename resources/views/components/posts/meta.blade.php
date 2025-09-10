{{-- @var \App\Models\Post $post --}}
@aware(['post', 'showUserLink' => false])

@if($showUserLink)
    <flux:text {{ $attributes->merge(['class' => 'mb-2']) }}>
        Posted by <flux:link :href="route('posts.user', ['user' => $post->user->id])" variant="subtle" wire:navigate>
            <strong class="dark:text-orange-400 text-orange-700">{{ $post->user->name }}</strong>
        </flux:link> on
        {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
@else
    <flux:text {{ $attributes->merge(['class' => 'mb-2']) }}>
        Posted on {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
@endif
