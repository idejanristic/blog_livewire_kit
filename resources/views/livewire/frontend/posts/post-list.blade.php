<div class="relative">
    <div class="mb-4" wire:offline.remove>
        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
    </div>

    @empty($posts)
        There are no posts.
    @else
        <div class="mb-4">
            <flux:text class="mt-2">
                Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $total }} results
            </flux:text>
        </div>

        @foreach ($posts as $post)
            <x-posts.post wire:key="post_{{ $post->id }}" :page="$posts->currentPage()" :post="$post">
                <x-posts.item />

                @livewire(
                    name: 'frontend.posts.meta',
                    params: [
                        'post' => $post,
                        'showUserLink' => true,
                        'class' => 'mb-4',
                    ],
                )

                <x-pages.tags :tags="$post->tags" :tagId="$tagId" />
            </x-posts.post>
        @endforeach
        <flux:separator class="mb-2 mt-2" />

        <div class="mb-4">
            <flux:text class="mt-2">
                Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $total }} results
            </flux:text>
        </div>

        {{ $posts->links('pagination::simple-tailwind') }}

        <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="absolute top-0 z-100 left-0 w-full h-full">
            <x-spinner />
        </div>
    @endempty

    <x-posts.delete />
</div>
