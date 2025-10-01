<form
    wire:submit.prevent="{{ $role && $role->exists ? 'update' : 'store' }}"
    class="flex w-full gap-6"
>
    <div class="flex w-full flex-col gap-4 lg:w-1/3">
        <flux:field>
            <flux:label>Name</flux:label>
            <flux:input
                wire:model.live.debounce.500ms="form.name"
                type="text"
            />
            <flux:error name="form.name" />
        </flux:field>

        <flux:field>
            <flux:label>Description:</flux:label>
            <flux:textarea
                wire:model.live.debounce.500ms="form.description"
                rows="8"
            />
            <flux:error name="form.description" />
        </flux:field>

        <flux:button
            variant="danger"
            type="submit"
            wire:loading.attr="disabled"
            wire:target="store,update"
        >
            {{ $role && $role->exists ? 'Edit Role' : 'Add Role' }}
        </flux:button>
    </div>

    <div class="flex w-full flex-col gap-4 lg:w-2/3">
        <flux:checkbox.group
            wire:model.live="form.permissions"
            label="Permissions"
        >
            <div class="grid grid-cols-4 gap-4">
                @foreach ($permissions as $permission)
                    <flux:checkbox
                        value="{{ $permission['id'] }}"
                        label="{{ $permission['name'] }}"
                        description="{{ $permission['description'] }}"
                    />
                @endforeach
            </div>
        </flux:checkbox.group>
    </div>
</form>
