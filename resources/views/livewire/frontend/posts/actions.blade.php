<flux:dropdown position="bottom" align="end">

    <flux:button icon="ellipsis-vertical" size="sm" />
    <flux:navmenu>
        <flux:navmenu.item href="{{ route('posts.show', ['post' => $post->id]) }}" icon="book-open" wire:navigate>
            Preview
        </flux:navmenu.item>
        @can(abilities: ['update'], arguments: $post)
            <flux:navmenu.item href="{{ route('user.posts.edit', ['post' => $post->id]) }}" icon="pencil-square"
                wire:navigate>
                Edit</flux:navmenu.item>
        @endcan
        @can(abilities: ['delete'], arguments: $post)
            <flux:navmenu.item x-data data-id="{{ $post->id }}" data-component-id="{{ $this->getId() }}" @click="window.dispatchEvent(
                                                        new CustomEvent('open-delete-confirmation', { detail: { id: $el.dataset.id, componentId: $el.dataset.componentId  }})
                                                    )" icon="trash" variant="danger">
                Delete
            </flux:navmenu.item>
        @endcan
    </flux:navmenu>

</flux:dropdown>
