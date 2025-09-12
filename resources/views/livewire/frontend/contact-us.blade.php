<form wire:submit="send" class="flex flex-col gap-6">
    <flux:field>
        <flux:label>Name</flux:label>
        <flux:input wire:model.live.debounce.500ms="form.name" @readonly="{{ $user && $user->exists }}" type="text" />
        <flux:error name="form.name" />
    </flux:field>

    <flux:field>
        <flux:label>Email</flux:label>
        <flux:input wire:model.live.debounce.500ms="form.email" @readonly="{{ $user && $user->exists }}" type="email" />
        <flux:error name="form.email" />
    </flux:field>

    <flux:field>
        <flux:label>Phone</flux:label>
        <flux:input wire:model.live.debounce.500ms="form.phone" type="text" mask="(999) 999-9999" />
        <flux:error name="form.phone" />
    </flux:field>

    <flux:field>
        <flux:label>Message:</flux:label>
        <flux:textarea wire:model.live.debounce.500ms="form.message" rows="8" />
        <flux:error name="form.message" />
    </flux:field>

    <div class="flex items-center justify-end">
        <flux:button variant="danger" type="submit" class="w-full">
            Send
        </flux:button>
    </div>
</form>
