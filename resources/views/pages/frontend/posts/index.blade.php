<x-layouts.frontend.app>
    <div class="max-w-2xl lg:mx-0 my-6">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty  sm:text-5xl">Blog</h2>
        <p class="mt-3 text-lg/8 ">All posts from The Blog</p>
    </div>

    <flux:separator class="mb-6 mt-2" />

    <div class="w-full lg:w-1/2">
        @livewire(name: 'frontend.posts.post-list')
    </div>
</x-layouts.frontend.app>
