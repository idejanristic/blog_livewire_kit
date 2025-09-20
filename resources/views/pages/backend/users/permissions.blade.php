<x-layouts.backend.app title="User" description="backend dashboard users">

    <x-pages.backend.header title="User {{ $user->profile_name }} ({{ $user->email }})" />

    <x-pages.backend.users-nav :user="$user" />

    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full min-h-150 lg:w-1/3">
            <x-card>
                <flux:heading size="lg">Permissions</flux:heading>

                <flux:separator class="mt-2 mb-2" />

                <table class="w-full text-sm text-left mb-4">
                    <thead class="text-xs uppercase border-b-2 dark:border-zinc-700 ">
                        <tr>
                            <th scope="col" class=" py-3">Name</th>
                            <th scope="col" class=" py-3">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr wire:key="{{ $permission->id }}" class="border-t dark:border-zinc-700">
                                <td class=" py-3 w-[200px]">{{ $permission->name}}</td>
                                <td class=" py-3">{{ $permission->description}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-card>
        </div>
    </div>
</x-layouts.backend.app>
