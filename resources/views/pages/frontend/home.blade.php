<x-layouts.frontend.app title="Home page"
    description="demo blog is a learning platform where users can display educational content, the most popular posts can be found on this page">

    <x-pages.header title="Demo Blog" subtitle="Learn how to grow your business with our expert advice" />

    <flux:separator class="mb-6 mt-2" />

    <div class="w-full min-h-150">
        @livewire('frontend.home.post-list')
    </div>
</x-layouts.frontend.app>
