<flux:dropdown position="bottom" align="end">
    <flux:button icon="ellipsis-vertical" size="sm" />
    <flux:navmenu>
        <flux:navmenu.item href="{{ route('posts.show', ['post' => $post->id]) }}" icon="book-open" wire:navigate>
            Preview
        </flux:navmenu.item>
        @can(['update'], $post)
            <flux:navmenu.item wire:click="edit" href="{{ route('posts.edit', ['post' => $post->id]) }}"
                icon="pencil-square" wire:navigate>Edit</flux:navmenu.item>
        @endcan
        @can(['delete'], $post)
            <flux:navmenu.separator />
            <flux:navmenu.item wire:click="delete" icon="trash" variant="danger">Delete</flux:navmenu.item>
        @endcan
    </flux:navmenu>
</flux:dropdown>
