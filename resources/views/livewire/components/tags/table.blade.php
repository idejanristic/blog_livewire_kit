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

    @if ($tags->count() == 0)
        There are no tags.
    @else
        @canany(['view.tag', 'delete.tag'])
            <table class="mb-4 w-full text-left text-sm">
                <thead class="bg-zinc-900/5 text-xs uppercase dark:bg-white/5">
                    <tr>
                        @include('partials.table.table-sortable-th', [
                            'name' => 'id',
                            'displayName' => 'ID',
                        ])

                        @include('partials.table.table-sortable-th', [
                            'name' => 'name',
                            'displayName' => 'name',
                        ])

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
                    @foreach ($tags as $tag)
                        <tr
                            wire:key="{{ $tag->id }}"
                            class="border-b dark:border-zinc-700"
                        >
                            <td class="px-4 py-3">{{ $tag->id }}</td>
                            <td class="px-4 py-3">
                                @if ($tag->posts_count > 0)
                                    <flux:text color="blue">
                                        <flux:link
                                            href="{{ route('posts.index', ['tag' => $tag->id]) }}"
                                            target="_blank"
                                        >
                                            {{ $tag->name }} ({{ $tag->posts_count }})
                                        </flux:link>
                                    </flux:text>
                                @else
                                    {{ $tag->name }}
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $tag->created_at->date() }}</td>
                            <td class="px-4 py-3">
                                @can(abilities: 'delete.tag')
                                    <flux:button
                                        variant="danger"
                                        size='xs'
                                        wire:click="delete({{ $tag->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="store,update"
                                    >Delete</flux:button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endcanany

        {{ $tags->links('livewire::tailwind', [
            'scrollTo' => false,
        ]) }}
    @endempty
    <livewire:components.delete-comfirmation title="user" />
</div>
