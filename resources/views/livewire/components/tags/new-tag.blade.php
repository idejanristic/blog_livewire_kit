<form class="flex flex-col gap-4">
    <flux:field>
        <flux:input
            wire:model.live="name"
            placeholder='tag...'
        />
        <flux:error name="name" />
    </flux:field>


    <flux:button
        icon="plus"
        wire:click.prevent="createTag()"
    >
        New tag
    </flux:button>
</form>
