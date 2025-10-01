<section class="w-full">
    <x-app.header title="Permission" />


    <div class="mt-4 flex w-full flex-col">
        <div class="min-h-150 w-full lg:w-1/3">
            <x-app.card>
                <flux:heading size="lg">Permission</flux:heading>

                <flux:separator class="mb-2 mt-2" />

                <x-app.card.col>
                    <flux:heading>Name:</flux:heading>
                    <flux:text>
                        {{ $permission->name }}
                    </flux:text>
                </x-app.card.col>

                <x-app.card.col>
                    <flux:heading>Description:</flux:heading>
                    <flux:text>{{ $permission->description }}</flux:text>
                </x-app.card.col>

                <x-app.card.row>
                    <flux:heading>Created at:</flux:heading>
                    <flux:text>{{ $permission->created_at->format('M d, Y') }}</flux:text>
                </x-app.card.row>

                <x-app.card.row>
                    <flux:heading>Modified at:</flux:heading>
                    <flux:text>{{ $permission->updated_at->format('M d, Y') }}</flux:text>
                </x-app.card.row>
            </x-app.card>
        </div>
    </div>
</section>
