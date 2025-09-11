<x-layouts.frontend.app title="Post" description="All posts published on demo blog">
    <div class="w-full min-h-150 lg:w-2/3">
        <x-pages.header title="Blog" subtitle="Posts was written by {{ $user->name }}" />

        <flux:separator class="mb-6 mt-2" />

        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('home') }}" wire:navigate>Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('posts.index') }}" wire:navigate>Blog</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                <span class="dark:text-orange-400 text-orange-700">{{ $user->name }}</span>
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        @livewire(name: 'frontend.posts.user-post-list', params: ['user' => $user])
    </div>
</x-layouts.frontend.app>
