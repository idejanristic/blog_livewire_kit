<div class="relative">
    <div class="mb-4" wire:offline.remove>
        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
    </div>

    @empty($posts)
        There are no posts.
    @else
        <div class="mb-4">
            <flux:text class="mt-2">
                Prikazano od {{ $posts->firstItem() }} do {{ $posts->lastItem() }}, ukupno {{ $total }}.
            </flux:text>
        </div>

        @foreach ($posts as $post)
            <div wire:key="{{ $post->id }}" class="mb-8">
                <flux:heading>{{ $post->title }}</flux:heading>
                <flux:text class="mt-2">{{ $post->excerpt }}</flux:text>
            </div>
        @endforeach


        <flux:separator class="mb-2 mt-2" />


        <div class="mb-4">
            <flux:text class="mt-2">
                Prikazano od {{ $posts->firstItem() }} do {{ $posts->lastItem() }}, ukupno {{ $total }}.
            </flux:text>
        </div>

        {{ $posts->links('pagination::simple-tailwind') }}

        <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="absolute top-0 z-100 left-0 w-full h-full">
            <x-spinner />
        </div>
    @endempty
</div>
