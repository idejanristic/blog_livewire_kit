@props(['comment'])

<div class="flex items-start justify-start gap-4">
    @can(abilities: 'delete', arguments: $comment)
        <button
            type="button"
            @click="Livewire.dispatch('comment_delete_event', {'id':  {{ $comment->id }}})"
            class="flex cursor-pointer items-center space-x-2 rounded-2xl text-red-500 transition hover:opacity-90"
        >
            <x-icons.delete />
        </button>
    @endcan
</div>
