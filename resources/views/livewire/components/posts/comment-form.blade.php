<div class="mb-4">
    @if ($user)
        <form
            wire:submit="store"
            class="flex flex-col gap-6"
        >
            <flux:field>
                <flux:textarea
                    wire:model.live.debounce.500ms="body"
                    rows="5"
                    placeholder="post comments"
                />
                <flux:error name="body" />
            </flux:field>
            <div class="flex items-center justify-start">
                <flux:button
                    variant="primary"
                    type="submit"
                >
                    add comment
                </flux:button>
            </div>
        </form>
    @else
        <flux:link href="{{ route(name: 'login') }}">
            Login to post comments
        </flux:link>
    @endif
</div>
