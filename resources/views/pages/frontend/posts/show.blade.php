@php
    use Illuminate\Support\Str;

    $shortTitle = Str::limit(value: $post->title, limit: 17, end: '...');
@endphp

<x-layouts.frontend.app title="{{ $shortTitle }}" description="{{ $post->excerpt }}">
    <div class="w-full min-h-150 lg:w-2/3">
        <x-pages.header title="{{ $post->title }}" subtitle="{{ $post->excerpt ?? '' }}" />

        <flux:separator class="mb-6 mt-2" />


        <div class="flex justify-between items-center">
            <flux:breadcrumbs class="mb-4 flex-1">
                <flux:breadcrumbs.item href="{{ route('home') }}" wire:navigate>Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('posts.index') }}" wire:navigate>Blog</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>
                    <span class="dark:text-orange-400 text-orange-700">Post</span>
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>

            @livewire('frontend.posts.actions', ['post' => $post])
        </div>

        <x-posts.meta :post="$post" class="mb-4" showUserLink="true" />

        {{ $post->body }}
    </div>
</x-layouts.frontend.app>
