@props(['comment'])

<div {{ $attributes->merge(['class' => 'mb-1 flex']) }}>
    <flux:text variant="subtle" class="flex-1"> <b>
            <flux:link class="mr-1" href="{{ route(name: 'posts.user', parameters: ['user' => $comment->user->id]) }}">
                @ {{ $comment->user->profile_name }}
            </flux:link>
        </b>
        {{ $comment->created_at->diffForHumans() }}
    </flux:text>
    <x-comments.actions :comment="$comment" />
</div>
