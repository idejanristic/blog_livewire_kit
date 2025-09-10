<x-layouts.frontend.app title="Post" description="All posts published on demo blog">
    <x-pages.header title="Blog" subtitle="All posts from The Blog" />

    <flux:separator class="mb-6 mt-2" />

    <div class="w-full lg:w-2/3">
        @livewire(name: 'frontend.posts.post-list')
    </div>
</x-layouts.frontend.app>
