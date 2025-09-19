<x-layouts.backend.app title="Dashboard" description="backend dashboard">
    <x-pages.backend.header title="Dashboard" />
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @livewire('backend.infos.info-list')

    </div>
</x-layouts.backend.app>
