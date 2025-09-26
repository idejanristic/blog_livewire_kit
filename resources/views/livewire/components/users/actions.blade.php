<flux:dropdown position="bottom" align="end">
    <flux:button icon="ellipsis-vertical" size="sm" />

    <flux:navmenu>
        @foreach($actions as $action)
            @if($this->isAllowed(action: $action))
                @if($action['name'] == 'delete')
                    @if($user->trashed())
                        <flux:navmenu.item icon="arrow-path" href="{{ route('admin.users.restore', ['id' => $user->id]) }}"
                            wire:navigate>
                            Restore
                        </flux:navmenu.item>
                    @else
                        <flux:navmenu.separator />

                        <flux:navmenu.item x-data data-id="{{ $user->id }}" data-component-id="{{ $this->getId() }}"
                            @click="window.dispatchEvent(new CustomEvent('open-delete-confirmation', { detail: { id: $el.dataset.id, componentId: $el.dataset.componentId  }}))"
                            icon="trash" variant="danger">
                            {{ ucfirst(string: $action['title']) }}
                        </flux:navmenu.item>
                    @endif
                @elseif (in_array(needle: $action['name'], haystack: ['addAuthorRole', 'removeRequest']))
                    @if($user->author_request)
                        <flux:navmenu.item icon="{{ $action['icon'] }}" href="{{ route($action['route'], ['id' => $user->id]) }}"
                            wire:navigate>
                            {{ ucfirst(string: $action['title']) }}
                        </flux:navmenu.item>
                    @endif
                @else
                    <flux:navmenu.item icon="{{ $action['icon'] }}" href="{{ route($action['route'], ['id' => $user->id]) }}"
                        wire:navigate>
                        {{ ucfirst(string: $action['title']) }}
                    </flux:navmenu.item>
                @endif
            @endif
        @endforeach
    </flux:navmenu>
</flux:dropdown>
