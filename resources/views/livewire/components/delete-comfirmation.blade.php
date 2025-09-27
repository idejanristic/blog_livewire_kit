<flux:modal
    name="delete-confirmation"
    x-data="{ id: 0, componentId: null }"
    class="md:w-96"
    x-on:open-delete-confirmation.window="
        $flux.modal('delete-confirmation').show();
        id = $event.detail.id;
        componentId = $event.detail.componentId;
    "
>
    <div class="space-y-6">
        <div class="w-full">
            <flux:heading size="xl">Delete {{ $title }}</flux:heading>
            <flux:text class="mt-2">
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button
                    variant="ghost"
                    @click="$flux.modal('delete-confirmation').close()"
                >Cancel
                </flux:button>
            </flux:modal.close>
            <flux:button
                variant="danger"
                @click="Livewire.find(componentId).delete().then(() => $flux.modal('delete-confirmation').close())"
            >
                Delete</flux:button>
        </div>
    </div>
</flux:modal>
