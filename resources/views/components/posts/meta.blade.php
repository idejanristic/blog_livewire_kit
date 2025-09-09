{{-- @var \App\Models\Post $post --}}
@props(['post'])

@if($post->user_id)
    <flux:text {{ $attributes->merge(['class' => 'mt-2']) }}>
        Posted by <flux:link :href="route('posts.show', ['post' => $post->id])" variant="subtle">
            <strong class="dark:text-orange-400 text-orange-700">{{ $post->user->name }}</strong>
        </flux:link> on
        {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
@else
    <flux:text {{ $attributes->merge(['class' => 'mt-2']) }}>
        Posted on {{ $post->published_at->toFormattedDateString() }}
    </flux:text>
@endif
