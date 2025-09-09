<x-layouts.frontend.app>
    <flux:heading size="xl">
        <h1>Home</h1>
    </flux:heading>


    <flux:separator class="mb-6 mt-2" />

    <div class="w-full lg:w-1/2">
        @livewire(name: 'frontend.posts.post-list')
    </div>
</x-layouts.frontend.app>
