@props(['tags' => [], 'tagId' => 0])

<div {{ $attributes->merge(['class' => 'mt-0']) }}>
    @foreach ($tags as $tag)
        @if ($tag->id == $tagId)
            <a href="{{ route('posts.index')}}" wire:navigate>
                <flux:badge wire:key="{{ $tag->id }}" class="mb-2" :color="$tag->id == $tagId ? 'orange' : 'gray'">
                    {{ $tag->name }}
                </flux:badge>
            </a>
        @else
            <a href="{{ route('posts.index', ['tag' => $tag->id]) }}" wire:navigate>
                <flux:badge wire:key="{{ $tag->id }}" class="mb-2">
                    {{ $tag->name }}
                </flux:badge>
            </a>
        @endif

    @endforeach
</div>
