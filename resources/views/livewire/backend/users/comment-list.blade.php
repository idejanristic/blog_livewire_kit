<div class="relative">
    <div class="mb-4 lg:w-1/3" wire:offline.remove>
        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
    </div>

    @empty($comments)
        There are no comments.
    @else
        <table class="w-full text-sm text-left mb-4">
            <thead class="text-xs uppercase border-b-4 dark:border-zinc-700 ">
                <tr>
                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'id',
                        'displayName' => 'ID',
                    ])

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'body',
                        'displayName' => 'body',
                    ])

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'created_at',
                        'displayName' => 'Created at',
                    ])
                    <th scope="col" class="px-4 py-3">Action</th>
                    </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr wire:key="{{ $comment->id }}" class="border-b dark:border-zinc-700">
                        <td class="px-4 py-3">{{ $comment->id}}</td>
                        <td class="px-4 py-3">{{ $comment->body}}</td>
                        <td class="px-4 py-3">{{ $comment->created_at->format('M d Y') }}</td>
                        <td class="px-4 py-3">
                            <flux:dropdown position="bottom" align="end">

                                <flux:button icon="ellipsis-vertical" size="sm" />

                                <flux:navmenu>


                                    <flux:navmenu.item href="#" icon="book-open" wire:navigate>
                                        Preview
                                    </flux:navmenu.item>

                                    <flux:menu.separator />

                                    <flux:navmenu.item href="#" icon="trash">
                                        Delete
                                    </flux:navmenu.item>
                                </flux:navmenu>

                            </flux:dropdown>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            {{ $comments->links('pagination::tailwind') }}

            <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="absolute top-0 z-100 left-0 w-full h-full">
                <x-spinner />
            </div>
    @endempty
</div>


