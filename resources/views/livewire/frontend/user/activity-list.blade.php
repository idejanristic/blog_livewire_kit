<div class="relative">
    <div class="mb-4" wire:offline.remove>
        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
    </div>

    @empty($activities)
        There are no activities.
    @else
        <div class="mb-4">
            <flux:text class="mt-2">
                Prikazano od {{ $activities->firstItem() }} do {{ $activities->lastItem() }}, ukupno {{ $total }}.
            </flux:text>
        </div>

        <div class="shadow-2xl">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase border-b-4 dark:border-zinc-700 ">
                    <tr>
                        <th scope="col" class="px-4 py-3">Type</th>
                        <th scope="col" class="px-4 py-3">Activity</th>
                        <th scope="col" class="px-4 py-3">Modified ad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr wire:key="{{ $activity->id }}" class="border-b dark:border-zinc-700">
                            <td class="px-4 py-3">{{ $activity->type}}</td>
                            <td class="px-4 py-3">{{ $activity->content}}</td>
                            <td class="px-4 py-3">{{ $activity->created_at->format('Y m d h:m:s')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <flux:text class="mt-2">
                Prikazano od {{ $activities->firstItem() }} do {{ $activities->lastItem() }}, ukupno {{ $total }}.
            </flux:text>
        </div>

        {{ $activities->links('pagination::tailwind') }}

        <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="absolute top-0 z-100 left-0 w-full h-full">
            <x-spinner />
        </div>
    @endempty

</div>
