<x-layouts.backend.app title="User" description="backend dashboard users">
    <x-pages.backend.header title="Users" />

    <div class="flex mt-6 w-full flex-1 flex-col gap-4 rounded-xl">
        @livewire('backend.users.user-list')
    </div>
</x-layouts.backend.app>
