@php
    use Illuminate\Support\Str;

    $shortTitle = Str::limit(value: $post->title, limit: 17, end: '...');
@endphp

<x-layouts.frontend.app title="{{ $shortTitle }}" description="{{ $post->excerpt }}">
    <x-pages.header title="{{ $post->title }}" subtitle="{{ $post->excerpt ?? '' }}" />

    <flux:separator class="mb-6 mt-2" />

    <div class="w-full min-h-150">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('home') }}">Home</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('posts.index') }}">Blog</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                <span class="dark:text-orange-400 text-orange-700">Post</span>
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <x-posts.meta :post=" $post" class="mb-4" />

        <div class="w-full lg:w-2/3">
            {{ $post->body }}
        </div>
    </div>
</x-layouts.frontend.app>
