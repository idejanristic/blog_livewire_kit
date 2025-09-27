<section class="w-full">
    <x-app.header
        title="User"
        subtitle="$user->name ($user->email)"
    />

    <div class="mt-6 flex w-full flex-col gap-6">
        <div class="min-h-150 w-full lg:w-1/3">
            <x-app.card>
                <x-app.card.row>
                    <flux:heading size="lg">Account</flux:heading>
                    <livewire:components.users.actions :user="$user" />
                </x-app.card.row>

                <flux:separator class="mb-2 mt-2" />

                <x-app.card.row>
                    <flux:heading>Online:</flux:heading>
                    <flux:text>
                        @if ($user->isOnline)
                            <x-icons.online.on />
                        @else
                            <x-icons.online.off />
                        @endif
                    </flux:text>
                </x-app.card.row>

                <x-app.card.row>
                    <flux:heading>Username:</flux:heading>
                    <flux:text>{{ $user->name }}</flux:text>
                </x-app.card.row>

                <x-app.card.row>
                    <flux:heading>Email:</flux:heading>
                    <flux:text>{{ $user->email }}</flux:text>
                </x-app.card.row>

                <x-app.card.row>
                    <flux:heading>Registered at:</flux:heading>
                    <flux:text>{{ $user->created_at->format('M d, Y') }}</flux:text>
                </x-app.card.row>

                <x-app.card.row>
                    <flux:heading>Modified at:</flux:heading>
                    <flux:text>{{ $user->updated_at->format('M d, Y') }}</flux:text>
                </x-app.card.row>

                <flux:separator class="mb-2 mt-2" />

                <x-app.card.row>
                    <flux:heading>Role:</flux:heading>
                    <div class="gap-1">
                        @foreach ($user->roles as $role)
                            <flux:text color="yellow">{{ $role->name }}</flux:text>
                        @endforeach
                    </div>
                </x-app.card.row>
            </x-app.card>

            @can('user.menage')
                <x-app.card>
                    <flux:heading size="lg">Manage roles</flux:heading>

                    <flux:separator class="mb-4 mt-2" />
                    @if ($user->isAdmin())
                        <flux:text color="yellow">A user with the administrator role cannot change roles.</flux:text>
                    @else
                        <flux:select
                            wire:model.live="selectedRole"
                            placeholder="Choose industry..."
                        >
                            @foreach ($roles as $role)
                                <flux:select.option
                                    value="{{ $role->id }}"
                                    vire:key="{{ $role->id }}"
                                >{{ $role->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                    @endif
                </x-app.card>
            @endcan

            <x-app.card>
                <flux:heading size="lg">Profile</flux:heading>

                <flux:separator class="mb-4 mt-2" />

                <div class="mb-2 flex items-center justify-between">
                    <flux:heading>First name:</flux:heading>
                    <flux:text>{{ $user->profile->first_name ?? '' }}</flux:text>
                </div>

                <div class="mb-2 flex items-center justify-between">
                    <flux:heading>Last name:</flux:heading>
                    <flux:text>{{ $user->profile->last_name ?? '' }}</flux:text>
                </div>

                <div class="mb-2 flex items-center justify-between">
                    <flux:heading>Title:</flux:heading>
                    <flux:text>{{ $user->profile->title ?? '' }}</flux:text>
                </div>
            </x-app.card>
        </div>
        <div class="w-full lg:w-2/3">

        </div>

        <livewire:components.delete-comfirmation title="user" />
    </div>
</section>
