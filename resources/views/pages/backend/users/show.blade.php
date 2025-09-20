<x-layouts.backend.app title="User" description="backend dashboard users">

    <x-pages.backend.header title="User {{ $user->profile_name }} ({{ $user->email }})" />

    <x-pages.backend.users-nav :user="$user" />

    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full min-h-150 lg:w-1/3">
            <x-card>
                <flux:heading size="lg">Account</flux:heading>

                <flux:separator class="mt-2 mb-2" />

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>Username:</flux:heading>
                    <flux:text>{{ $user->name }}</flux:text>
                </div>

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>Profile name:</flux:heading>
                    <flux:text>{{ $user->profile_name }}</flux:text>
                </div>

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>Registered at:</flux:heading>
                    <flux:text>{{ $user->created_at->format('Y m d')}}</flux:text>
                </div>

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>Modified at:</flux:heading>
                    <flux:text>{{ $user->updated_at->format('Y m d')}}</flux:text>
                </div>

                <flux:separator class="mt-2 mb-2" />

                <div class="flex justify-between items-center ">
                    <flux:heading>Role:</flux:heading>
                    <div class="gap-1">
                        @foreach ($user->roles as $role)
                            <flux:text color="yellow">{{ $role->name }}</flux:text>
                        @endforeach
                    </div>
                </div>
            </x-card>

            @can('user.menage')
                <x-card>
                    <flux:heading size="lg">Manage roles</flux:heading>

                    <flux:separator class="mt-2 mb-4" />

                    @livewire('backend.users.roles-select', [
                        'roles' => $allRoles,
                        'selected' => $user->roles->toArray(),
                    ])
                        </x-card>

            @endcan

            <x-card>
                <flux:heading size="lg">Profile</flux:heading>

                <flux:separator class="mt-2 mb-4" />

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>First name:</flux:heading>
                    <flux:text>{{ $user->profile->first_name ?? ''}}</flux:text>
                </div>

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>Last name:</flux:heading>
                    <flux:text>{{ $user->profile->last_name ?? '' }}</flux:text>
                </div>

                <div class="flex justify-between items-center mb-2">
                    <flux:heading>Title:</flux:heading>
                    <flux:text>{{ $user->profile->title ?? '' }}</flux:text>
                </div>
</x-card>
        </div>
        <div class="w-full lg:w-2/3">

        </div>
    </div>
</x-layouts.backend.app>
