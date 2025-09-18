@props(['comment'])

<div class="flex mb-6 border-t-1 border-zinc-800 pt-3">
    <div class="pr-2">
        <x-avatar :user="$comment->user" size="sm" />
    </div>
    <div class="flex-1 px-2">
        <x-comments.meta :comment="$comment" />
        <x-comments.body :comment="$comment" />

        <div class='flex space-x-4 mt-2'>
            <button type="button" class="flex gap-1 items-center space-x-2 rounded-2xl transition"
                @click="Livewire.dispatch('comment_like', {'id':  {{ $comment->id }}})">
                {{ $comment->like_count }}
                <x-icons.like />
            </button>

            <button type="button" class="flex gap-1 items-center space-x-2 rounded-2xl transition"
                @click="Livewire.dispatch('comment_dislike', {'id':  {{ $comment->id }}})">
                {{ $comment->dislike_count }}
                <x-icons.dislike />
            </button>
        </div>
    </div>
</div>
