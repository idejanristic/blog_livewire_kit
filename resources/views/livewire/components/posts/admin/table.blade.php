<div class="relative mb-4">
    <div
        class="mb-4 flex items-center justify-between"
        wire:offline.remove
    >
        <div class="flex flex-1 items-center gap-4">
            <div class="flex w-[70px]">
                <flux:select
                    wire:model.live="perPage"
                    placeholder="Choose..."
                >
                    <flux:select.option>5</flux:select.option>
                    <flux:select.option>10</flux:select.option>
                    <flux:select.option>20</flux:select.option>
                    <flux:select.option>50</flux:select.option>
                </flux:select>
            </div>
            entries per page
        </div>

        <div class="flex w-[250px] items-center">
            <flux:input
                wire:model.live.debounce.300ms="search"
                icon="magnifying-glass"
                placeholder="Search..."
            />
        </div>
    </div>

    @if ($posts->count() == 0)
        There are no users.
    @else
        <table class="mb-4 w-full text-left text-sm">
            <thead class="bg-zinc-900/5 text-xs uppercase dark:bg-white/5">
                <tr>
                    @include('partials.table.table-sortable-th', [
                        'name' => 'id',
                        'displayName' => 'ID',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'title',
                        'displayName' => 'Title',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'excerpt',
                        'displayName' => 'Excerpt',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'published_at',
                        'displayName' => 'Published  at',
                    ])

                    <th
                        scope="col"
                        class="px-4 py-3"
                    ></th>

                    @include('partials.table.table-sortable-th', [
                        'name' => 'created_at',
                        'displayName' => 'Created at',
                    ])

                    <th
                        scope="col"
                        class="w-[50px] px-4 py-3"
                    ></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr
                        wire:key="{{ $post->id }}"
                        class="border-b dark:border-zinc-700"
                    >
                        <td class="px-4 py-3">{{ $post->id }}</td>
                        <td class="px-4 py-3">
                            @if ($post->trashed())
                                <flux:text color="blue">
                                    <flux:link
                                        href="{{ route('posts.trash', ['id' => $post->id]) }}"
                                        target="_blank"
                                    >
                                        {{ $post->title }}
                                    </flux:link>
                                </flux:text>
                            @else
                                <flux:text color="blue">
                                    <flux:link
                                        href="{{ route('posts.show', ['id' => $post->id]) }}"
                                        target="_blank"
                                    >
                                        {{ $post->title }}
                                    </flux:link>
                                </flux:text>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            {{ Str::limit(value: $post->excerpt, limit: 100, end: ' ...') }}
                        </td>
                        <td class="px-4 py-3">{{ $post->published_at->date() }}</td>
                        <td class="w-[250px] px-4 py-3">
                            <div class="flex gap-2">
                                <div class="flex items-center gap-1 space-x-2 rounded-2xl transition">
                                    {{ $post->like_count }}
                                    <x-icons.like />
                                </div>

                                <div class="flex items-center gap-1 space-x-2 rounded-2xl transition">
                                    {{ $post->dislike_count }}
                                    <x-icons.dislike />
                                </div>
                                <flux:text class="flex gap-1 font-bold text-zinc-900 dark:text-white">
                                    {{ $post->comments_count }}
                                    <x-icons.comment />
                                </flux:text>

                                <flux:text class="font-bold text-zinc-900 dark:text-white">
                                    {{ $post->view_count }} views
                                </flux:text>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $post->created_at->date() }}</td>
                        <td class="px-4 py-3">
                            <flux:dropdown
                                position="bottom"
                                align="end"
                            >
                                <flux:button
                                    icon="ellipsis-vertical"
                                    size="sm"
                                />

                                <flux:navmenu>
                                    @if ($post->trashed())
                                        <flux:navmenu.item
                                            icon="eye"
                                            href="{{ route('posts.trash', ['id' => $post->id]) }}"
                                            target="_blank"
                                        >
                                            Preview
                                        </flux:navmenu.item>
                                    @else
                                        <flux:navmenu.item
                                            icon="eye"
                                            href="{{ route('posts.show', ['id' => $post->id]) }}"
                                            target="_blank"
                                        >
                                            Preview
                                        </flux:navmenu.item>
                                    @endif

                                    @if ($post->trashed())
                                        <flux:navmenu.item
                                            icon="arrow-path"
                                            wire:click="restore({{ $post->id }})"
                                        >
                                            Restore
                                        </flux:navmenu.item>
                                    @else
                                        <flux:navmenu.item
                                            icon="trash"
                                            wire:click="delete({{ $post->id }})"
                                        >
                                            Delete
                                        </flux:navmenu.item>
                                    @endif
                                </flux:navmenu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links('livewire::tailwind', [
            'scrollTo' => false,
        ]) }}
    @endif
    <livewire:components.delete-comfirmation title="user" />
</div>
