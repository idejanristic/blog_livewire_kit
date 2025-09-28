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

        @auth
            <div class='mt-2 flex space-x-4'>
                <button
                    type="button"
                    class="flex items-center gap-1 space-x-2 rounded-2xl transition"
                    @click="Livewire.dispatch('comment_like', {'id':  {{ $comment->id }}})"
                >
                    {{ $comment->like_count }}
                    <x-icons.like />
                </button>

                <button
                    type="button"
                    class="flex items-center gap-1 space-x-2 rounded-2xl transition"
                    @click="Livewire.dispatch('comment_dislike', {'id':  {{ $comment->id }}})"
                >
                    {{ $comment->dislike_count }}
                    <x-icons.dislike />
                </button>
            </div>
        @else
            <div class='mt-2 flex space-x-4'>
                <div class="flex items-center gap-1 space-x-2 rounded-2xl transition">
                    {{ $comment->like_count }}
                    <x-icons.like />
                </div>

                <div class="flex items-center gap-1 space-x-2 rounded-2xl transition">
                    {{ $comment->dislike_count }}
                    <x-icons.dislike />
                </div>
            </div>
        @endauth

    </div>
</div>
