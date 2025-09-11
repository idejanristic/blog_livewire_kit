<x-layouts.frontend.app title="Create post" description="form for create post">
    <div class="w-full min-h-150 lg:w-2/3">
        <x-pages.header title="Create a new post" />

        <flux:separator class="mb-6 mt-2" />

        <div class="w-full min-h-150">
            @livewire('frontend.posts.form')
        </div>
    </div>
</x-layouts.frontend.app>
