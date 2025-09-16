<x-layouts.frontend.app title="Post" description="All posts published on demo blog">
    <x-pages.header title="Blog" subtitle="Posts was written by {{ $user->profile_name }}" />

    <flux:separator class="mb-6 mt-2" />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">

            <flux:breadcrumbs class="mb-4">
                <flux:breadcrumbs.item href="{{ route('home') }}" wire:navigate>Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('posts.index') }}" wire:navigate>Blog</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>
                    <span class="dark:text-orange-400 text-orange-700">{{ $user->profile_title }}
                        {{ $user->profile_name }}</span>
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>

            @livewire(name: 'frontend.posts.user.post-list', params: ['user' => $user])
        </div>

        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>

    </div>
</x-layouts.frontend.app>
