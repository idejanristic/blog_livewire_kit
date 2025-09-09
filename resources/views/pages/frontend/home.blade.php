<x-layouts.frontend.app>
    <x-pages.header title="Demo Blog" subtitle="Learn how to grow your business with our expert advice" />

    <flux:separator class="mb-6 mt-2" />

    <div class="w-full min-h-150">
        @livewire('frontend.home.post-list')
    </div>
</x-layouts.frontend.app>
