<x-layouts.frontend.app title="Post" description="All posts published on demo blog">
    <div class="w-full min-h-150 lg:w-2/3">
        <x-pages.header title="Blog" subtitle="All posts from The Blog" />

        <flux:separator class="mb-6 mt-2" />


        @livewire(name: 'frontend.posts.post-list')
    </div>
</x-layouts.frontend.app>
