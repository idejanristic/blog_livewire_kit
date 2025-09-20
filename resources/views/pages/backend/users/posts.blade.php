<x-layouts.backend.app title="User" description="backend dashboard users">

    <x-pages.backend.header title="User {{ $user->profile_name }} ({{ $user->email }})" />

    <x-pages.backend.users-nav :user="$user" />

    <div class="flex  w-full flex-1 flex-col gap-4 rounded-xl">
        @livewire('backend.users.post-list', ['user' => $user])
    </div>
</x-layouts.backend.app>
