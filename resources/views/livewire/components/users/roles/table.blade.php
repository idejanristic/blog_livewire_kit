<table class="mb-4 w-full text-left text-sm">
    <thead class="bg-zinc-900/5 text-xs uppercase dark:bg-white/5">
        <tr>
            <th
                scope="col"
                class="w-[50px] px-4 py-3"
            >
                ID</th>

            @include('partials.table.table-sortable-th', [
                'name' => 'name',
                'displayName' => 'Name',
            ])

            @include('partials.table.table-sortable-th', [
                'name' => 'description',
                'displayName' => 'Description',
            ])


            <th
                scope="col"
                class="px-4 py-3"
            >
                Competence</th>

            @include('partials.table.table-sortable-th', [
                'name' => 'created_at',
                'displayName' => 'Created at',
            ])

            <th
                scope="col"
                class="px-4 py-3"
            ></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr
                wire:key="{{ $role->id }}"
                class="border-b dark:border-zinc-700"
            >
                <td class="px-4 py-3">{{ $role->id }}</td>
                <td class="px-4 py-3">{{ $role->name }}</td>
                <td class="px-4 py-3">{{ $role->description }}</td>
                <td class="px-4 py-3">
                    @if ($role->permissions->count() > 0)
                        @foreach ($role->permissions as $p)
                            <a
                                href="{{ route('admin.users.permissions.show', ['id' => $p->id]) }}"
                                wire:navigate
                            >
                                <flux:badge
                                    wire:key="{{ $p->id }}"
                                    class="m-0.5"
                                >
                                    {{ $p->name }}
                                </flux:badge>
                            </a>
                        @endforeach
                    @endif
                </td>
                <td class="px-4 py-3">{{ $role->created_at->date() }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-3">

                        <flux:button
                            color="sky"
                            variant="primary"
                            size='xs'
                            href="{{ route('admin.users.roles.edit', ['id' => $role->id]) }}"
                        >Edit role</flux:button>
                        @if ($role->users_count == 0 && App\Acl\Enums\RoleType::notHas(value: $role->slug))
                            <flux:button
                                color="red"
                                variant="primary"
                                size='xs'
                                wire:click="delete({{ $role->id }})"
                            >Delete role</flux:button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
