@props(['comment'])

<flux:text {{ $attributes }}>
    <div class="italic">{{ $comment->body }}</div>
</flux:text>
