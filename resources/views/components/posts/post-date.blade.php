@aware(['post'])

<flux:text {{ $attributes->merge(['class' => 'mb-2']) }}>
    {{ $post->published_at->date() }}
</flux:text>
