@props(['comment'])

<div class="border-t-1 mb-6 flex border-zinc-800 pt-3">
    <div class="pr-2">
        <x-avatar
            :user="$comment->user"
            size="sm"
        />
    </div>
    <div class="flex-1 px-2">
        <x-comment.meta :comment="$comment" />
        <x-comment.body :comment="$comment" />
    </div>
</div>
