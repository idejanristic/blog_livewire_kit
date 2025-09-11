<x-layouts.frontend.app title="Create post" description="form for create post">

    <x-pages.header title="Create a new post" />

    <flux:separator class="mb-6 mt-2" />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            @livewire('frontend.posts.form')
        </div>

        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>
    </div>

</x-layouts.frontend.app>
