@php
    use App\Enums\PublishedType;
@endphp
<div class="relative">
    <div
        class="mb-4"
        wire:offline.remove
    >
        <flux:input
            wire:model.live.debounce.300ms="search"
            icon="magnifying-glass"
            placeholder="Search..."
        />
    </div>

    @if ($showTabs)
        <div class="mb-4 flex gap-2">
            @foreach (PublishedType::cases() as $type)
                @if ($type->isActive(publishedType: $publishedType))
                    <flux:button
                        variant="primary"
                        wire:click="setPublishedType('{{ $type->value }}')"
                        size="sm"
                    >
                        {{ $type->label() }}
                    </flux:button>
                @else
                    <flux:button
                        wire:click="setPublishedType('{{ $type->value }}')"
                        size="sm"
                    >
                        {{ $type->label() }}
                    </flux:button>
                @endif
            @endforeach
        </div>
    @endif

    @empty($posts && $posts->count() > 0)
        There are no posts.
    @else
        <x-posts.table-results
            firstItem="{{ $posts->firstItem() }}"
            lastItem="{{ $posts->lastItem() }}"
            :total="$total"
        />

        @foreach ($posts as $post)
            <x-posts.post
                wire:key="post_{{ $post->id }}"
                :page="$posts->currentPage()"
                :post="$post"
            >
                <x-posts.post-item />

                <livewire:components.posts.meta
                    :post="$post"
                    showUserLink="{{ $user ? false : true }}"
                    :key="'post_meta_' . $post->id . '_page_' . $posts->currentPage()"
                />
            </x-posts.post>
        @endforeach

        <flux:separator class="mb-2 mt-2" />

        <x-posts.table-results
            firstItem="{{ $posts->firstItem() }}"
            lastItem="{{ $posts->lastItem() }}"
            :total="$total"
        />

        {{ $posts->links('livewire::simple-tailwind', ['scrollTo' => false]) }}

        <div
            wire:loading
            wire:target="previousPage,nextPage,gotoPage"
            class="z-100 absolute left-0 top-0 h-full w-full"
        >
            <x-spinner />
        </div>

        <livewire:components.posts.delete-confirmation />
    @endempty
</div>
