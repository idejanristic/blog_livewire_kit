@props(['comment'])

<div class="flex justify-start items-start gap-4">
    {{-- @can(abilities: 'update', arguments: $comment)
    <button type="button"
        class="flex items-center space-x-2 hover:opacity-90 text-blue-500 cursor-pointer rounded-2xl transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </button>
    @endcan --}}

    @can(abilities: 'delete', arguments: $comment)
        <button type="button" @click="Livewire.dispatch('comment_delete_event', {'id':  {{ $comment->id }}})"
            class="flex items-center space-x-2 hover:opacity-90 text-red-500 cursor-pointer rounded-2xl transition">
            <x-icons.delete />
        </button>
    @endcan
</div>
