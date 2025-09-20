<div class="relative">
    <div class="mb-4 lg:w-1/3" wire:offline.remove>
        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
    </div>

    @empty($users)
        There are no users.
    @else
        <table class="w-full text-sm text-left mb-4">
            <thead class="text-xs uppercase border-b-4 dark:border-zinc-700 ">
                <tr>
                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'id',
                        'displayName' => 'ID',
                    ])
                        @include('partials.frontend.table-sortable-th', [
                        'name' => 'name',
                        'displayName' => 'Username',
                    ])
                        @include('partials.frontend.table-sortable-th', [
                        'name' => 'name',
                        'displayName' => 'Profile name',
                    ])

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'email',
                        'displayName' => 'Email',
                    ])

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'role',
                        'displayName' => 'Role',
                    ])

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'created_at',
                        'displayName' => 'Created at',
                    ])
                    <th></th>
                    </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr wire:key="{{ $user->id }}" class="border-b dark:border-zinc-700">
                    <td class="px-4 py-3">{{ $user->id}}</td>

                    <td class="px-4 py-3">{{ $user->name}}</td>

                    <td class="px-4 py-3">{{ $user->profile_name}}</td>

                    <td class="px-4 py-3">
                        <flux:text color="blue">
                            <flux:link href="{{ route('backend.users.show', ['user' => $user->id]) }}">
                                {{ $user->email}}
                            </flux:link>
                        </flux:text>
                    </td>

                    <td class="px-4 py-3">
                        @foreach ($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>

                    <td class="px-4 py-3">{{ $user->created_at->format('Y m d h:m:s')}}</td>

                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>


        {{ $users->links('pagination::tailwind') }}

        <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="absolute top-0 z-100 left-0 w-full h-full">
            <x-spinner />
        </div>
    @endempty
</div>
