@php
    use Illuminate\Support\Str;

    $shortTitle = Str::limit(value: $post->title, limit: 17, end: '...');
@endphp

<x-layouts.frontend.app title="{{ $shortTitle }}" description="{{ $post->excerpt }}">
    <x-pages.header title="{{ $post->title }}" subtitle="{{ $post->excerpt ?? '' }}" />

    <flux:separator class="mb-6 mt-2" />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            <div class="flex justify-between items-center">
                <flux:breadcrumbs class="mb-4 flex-1">
                    <flux:breadcrumbs.item href="{{ route('home') }}" wire:navigate>Home</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item href="{{ route('posts.index') }}" wire:navigate>Blog</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item>
                        <span class="dark:text-orange-400 text-orange-700">Post</span>
                    </flux:breadcrumbs.item>
                </flux:breadcrumbs>
                @auth
                    @livewire('frontend.posts.actions', ['post' => $post])
                @endauth
            </div>

            <x-posts.meta :post="$post" class="mb-4" showUserLink="true" />

            {{ $post->body }}
        </div>

        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>
    </div>
</x-layouts.frontend.app>
