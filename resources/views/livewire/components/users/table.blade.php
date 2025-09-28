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

    @if ($users->count() == 0)
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
                        'name' => 'name',
                        'displayName' => 'Username',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'email',
                        'displayName' => 'Email',
                    ])

                    <th
                        scope="col"
                        class="w-[50px] px-4 py-3"
                    >Role</th>

                    @include('partials.table.table-sortable-th', [
                        'name' => 'created_at',
                        'displayName' => 'Created at',
                    ])

                    @include('partials.table.table-sortable-th', [
                        'name' => 'author_request',
                        'displayName' => 'Author request',
                    ])

                    <th
                        scope="col"
                        class="w-[50px] px-4 py-3"
                    ></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        wire:key="{{ $user->id }}"
                        class="border-b dark:border-zinc-700"
                    >
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="flex items-center justify-start gap-4 px-4 py-3">
                            {{ $user->profile_name }}
                            @if ($user->isOnline)
                                <x-icons.online.on />
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <flux:text color="blue">
                                <flux:link
                                    href="{{ route('admin.users.show', ['id' => $user->id]) }}"
                                    wire:navigate
                                >
                                    {{ $user->email }}
                                </flux:link>
                            </flux:text>
                        </td>
                        <td class="px-4 py-3">
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>
                        <td class="px-4 py-3">{{ $user->created_at->date() }}</td>
                        <td class="px-4 py-3">
                            @if ($user->author_request)
                                <x-icons.check class="text-green-500" />
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <livewire:components.users.actions
                                :user="$user"
                                :key="'user_actions_' . $user->id . '_page_' . $users->currentPage()"
                            />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links('livewire::tailwind', [
            'scrollTo' => false,
        ]) }}
    @endif
    <livewire:components.delete-comfirmation title="user" />
</div>
