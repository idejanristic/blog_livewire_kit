{{-- @var \App\Models\Post $post --}}
@aware(['post'])


<flux:text {{ $attributes->merge(['class' => 'mb-2']) }}>
    {{ $post->published_at->toFormattedDateString() }}
</flux:text>
