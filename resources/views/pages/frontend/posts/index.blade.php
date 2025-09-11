<x-layouts.frontend.app title="Post" description="All posts published on demo blog">
    <x-pages.header title="Blog" subtitle="All posts from The Blog" />

    <flux:separator class="mb-6 mt-2" />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            @livewire(name: 'frontend.posts.post-list')
        </div>

        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>

    </div>
</x-layouts.frontend.app>
