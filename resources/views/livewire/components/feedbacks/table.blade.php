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

    @if ($feedbacks->count() == 0)
        There are no feedbacks.
    @else
        <table class="mb-4 w-full text-left text-sm">
            <thead class="bg-zinc-900/5 text-xs uppercase dark:bg-white/5">
                <tr>
                    @include('partials.table.table-sortable-th', [
                        'name' => 'id',
                        'displayName' => 'ID',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'name',
                        'displayName' => 'Name',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'email',
                        'displayName' => 'Email',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'message',
                        'displayName' => 'Massage',
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
                @foreach ($feedbacks as $feedback)
                    <tr
                        wire:key="{{ $feedback->id }}"
                        class="border-b dark:border-zinc-700"
                    >
                        <td class="px-4 py-3">{{ $feedback->id }}</td>
                        <td class="px-4 py-3">{{ $feedback->name }}</td>
                        <td class="px-4 py-3">{{ $feedback->email }}</td>
                        <td class="px-4 py-3">
                            <flux:text color="blue">
                                <flux:link
                                    href="{{ route('admin.feedbacks.show', ['id' => $feedback->id]) }}"
                                    wire:navigate
                                >
                                    {{ Str::limit(value: $feedback->message, limit: 100, end: '...') }}
                                </flux:link>
                            </flux:text>
                        </td>
                        <td class="px-4 py-3">{{ $feedback->created_at->date() }}</td>
                        <td class="px-4 py-3">
                            <livewire:components.feedbacks.actions
                                :feedback="$feedback"
                                :key="'feedback_actions_' . $feedback->id . '_page_' . $feedbacks->currentPage()"
                            />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $feedbacks->links('livewire::tailwind', [
            'scrollTo' => false,
        ]) }}
    @endempty
    <livewire:components.delete-comfirmation title="feedback" />
</div>
