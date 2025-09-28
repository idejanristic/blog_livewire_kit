<form class="flex flex-col gap-4">
    <flux:field>
        <flux:label>Tag</flux:label>
        <flux:input wire:model.live="name" />
        <flux:error name="name" />
    </flux:field>

    <div>
        <flux:button
            icon="plus"
            wire:click.prevent="createTag()"
        >
            New tag
        </flux:button>
    </div>
</form>
