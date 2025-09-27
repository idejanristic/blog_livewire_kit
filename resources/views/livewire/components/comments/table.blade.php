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

    @if ($comments->count() == 0)
        There are no tags.
    @else
        <table class="mb-4 w-full text-left text-sm">
            <thead class="bg-zinc-900/5 text-xs uppercase dark:bg-white/5">
                <tr>
                    @include('partials.table.table-sortable-th', [
                        'name' => 'id',
                        'displayName' => 'ID',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'body',
                        'displayName' => 'Comment',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'post_id',
                        'displayName' => 'Post',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'user_id',
                        'displayName' => 'User',
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
                @foreach ($comments as $comment)
                    <tr
                        wire:key="{{ $comment->id }}"
                        class="border-b dark:border-zinc-700"
                    >
                        <td class="px-4 py-3">{{ $comment->id }}</td>
                        <td class="px-4 py-3">
                            {{ Str::limit(value: $comment->body, limit: 100, end: '...') }}
                        </td>
                        <td class="px-4 py-3">
                            <flux:text color="blue">
                                <flux:link
                                    href="{{ route('posts.show', ['id' => $comment->user->id]) }}"
                                    target="_blank"
                                >
                                    {{ $comment->post->title }}
                                </flux:link>
                            </flux:text>
                        </td>
                        <td class="px-4 py-3">
                            <flux:text color="blue">
                                <flux:link
                                    href="{{ route('admin.users.show', ['id' => $comment->user->id]) }}"
                                    wire:navigate
                                >
                                    {{ $comment->user->name }}
                                </flux:link>
                            </flux:text>
                        </td>
                        <td class="px-4 py-3">{{ $comment->created_at->date() }}</td>
                        <td class="px-4 py-3">
                            <flux:button
                                variant="danger"
                                size='xs'
                                wire:click="delete({{ $comment->id }})"
                            >Delete</flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $comments->links('livewire::tailwind', [
            'scrollTo' => false,
        ]) }}
    @endempty
    <livewire:components.delete-comfirmation title="user" />
</div>
