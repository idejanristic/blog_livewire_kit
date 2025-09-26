<div class="relative mb-4">
    <div class="mb-4 flex justify-between items-center" wire:offline.remove>
        <div class="flex flex-1 items-center gap-4">
            <div class="w-[70px] flex">
                <flux:select wire:model.live="perPage" placeholder="Choose..." >
                    <flux:select.option>5</flux:select.option>
                    <flux:select.option>10</flux:select.option>
                    <flux:select.option>20</flux:select.option>
                    <flux:select.option>50</flux:select.option>
                </flux:select>
            </div>
            entries per page
        </div>

        <div class="w-[200px] flex items-center">
            <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
        </div>
    </div>

    @if($users->count() == 0)
        There are no users.
    @else

    <table class="w-full text-sm text-left mb-4">
        <thead class="text-xs uppercase bg-zinc-900/5 dark:bg-white/5">
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

                <th scope="col" class="px-4 py-3 w-[50px]">Role</th>

                @include('partials.table.table-sortable-th', [
                    'name' => 'created_at',
                    'displayName' => 'Created at',
                ])

                <th scope="col" class="px-4 py-3 w-[50px]"></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr wire:key="{{ $user->id }}" class="border-b dark:border-zinc-700">
                <td class="px-4 py-3">{{ $user->id}}</td>
                <td class="px-4 py-3 flex justify-start items-center gap-4">
                    {{ $user->name}}
                     @if ($user->isOnline)
                        <x-icons.online.on />
                    @endif
                </td>
                <td class="px-4 py-3">
                    <flux:text color="blue">
                        <flux:link href="{{ route('admin.users.show', ['id' => $user->id]) }}" wire:navigate>
                            {{ $user->email}}
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
                    <flux:dropdown position="bottom" align="end">
                        <flux:button icon="ellipsis-vertical" size="sm" />
                            <flux:navmenu>
                                <flux:navmenu.item href="{{ route('admin.users.show', ['id' => $user->id]) }}"  icon="book-open" wire:navigate>
                                    Preview
                                </flux:navmenu.item>

                                @unless ($user->isAdmin())
                                <flux:menu.separator />

                                <flux:navmenu.item type="button" wire:click="deleteItem({{ $user->id }})" icon="trash">
                                    Delete
                                </flux:navmenu.item>
                                @endunless
                        </flux:navmenu>
                    </flux:dropdown>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links('livewire::tailwind', [
        'scrollTo' => false
    ]) }}
    @endempty
</div>
