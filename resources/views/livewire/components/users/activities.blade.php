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

    @empty($activities)
        There are no activities.
    @else
        <div class="shadow-2xl">
            <table class="mb-4 w-full text-left text-sm">
                <thead class="border-b-4 text-xs uppercase dark:border-zinc-700">
                    <tr>
                        @include('partials.table.table-sortable-th', [
                            'name' => 'type',
                            'displayName' => 'Type',
                        ])

                        @include('partials.table.table-sortable-th', [
                            'name' => 'content',
                            'displayName' => 'Content',
                        ])
                        @include('partials.table.table-sortable-th', [
                            'name' => 'created_at',
                            'displayName' => 'Modified ad',
                        ])

                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr
                            wire:key="{{ $activity->id }}"
                            class="border-b dark:border-zinc-700"
                        >
                            <td class="px-4 py-3">{{ $activity->type }}</td>
                            <td class="px-4 py-3">{{ $activity->content }}</td>
                            <td class="px-4 py-3">{{ $activity->created_at->format('Y m d h:m:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $activities->links('pagination::tailwind') }}

        <div
            wire:loading
            wire:target="previousPage,nextPage,gotoPage"
            class="z-100 absolute left-0 top-0 h-full w-full"
        >
            <x-spinner />
        </div>
    @endempty

</div>
