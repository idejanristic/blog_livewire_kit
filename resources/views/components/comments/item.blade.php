@props(['comment'])

<div class="flex mb-6 border-t-1 border-zinc-800 pt-3">
    <div class="pr-2">
        <x-avatar :user="$comment->user" size="sm" />
    </div>
    <div class="flex-1 px-2">
        <x-comments.meta :comment="$comment" />
        <x-comments.body :comment="$comment" />
        <x-reaction class="mt-2" />
    </div>
</div>
