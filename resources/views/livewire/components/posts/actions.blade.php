<flux:dropdown
    position="bottom"
    align="end"
>
    <flux:button
        icon="ellipsis-vertical"
        size="sm"
        class="ml-1"
    />

    <flux:navmenu>
        @foreach ($actions as $action)
            @if ($this->isAllowed(action: $action, post: $post))
                @if ($action['name'] == 'delete')
                    <flux:navmenu.separator />

                    <flux:navmenu.item
                        x-data
                        data-id="{{ $post->id }}"
                        data-component-id="{{ $this->getId() }}"
                        @click="window.dispatchEvent(new CustomEvent('open-delete-confirmation', { detail: { id: $el.dataset.id, componentId: $el.dataset.componentId  }}))"
                        icon="trash"
                        variant="danger"
                    >
                        {{ ucfirst(string: $action['title']) }}
                    </flux:navmenu.item>
                @else
                    <flux:navmenu.item
                        href="{{ route($action['route'], ['id' => $post->id]) }}"
                        icon="{{ $action['icon'] }}"
                        wire:navigate
                    >
                        {{ ucfirst(string: $action['title']) }}
                    </flux:navmenu.item>
                @endif
            @endif
        @endforeach
    </flux:navmenu>
</flux:dropdown>
