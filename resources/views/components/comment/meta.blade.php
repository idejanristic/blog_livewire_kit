@props(['comment'])

<div {{ $attributes->merge(['class' => 'mb-1 flex']) }}>
    <flux:text
        variant="subtle"
        class="flex-1"
    > <b>
            <flux:link
                class="mr-1"
                href="{{ route(name: 'posts.user', parameters: ['id' => $comment->user->id]) }}"
            >
                @ {{ $comment->user->profile_title }} {{ $comment->user->profile_name }}
            </flux:link>
        </b>
        {{ $comment->created_at->diffForHumans() }}
    </flux:text>
    <x-comment.actions :comment="$comment" />
</div>
