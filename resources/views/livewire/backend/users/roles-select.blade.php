@props(['tags' => []])


<div class="flex flex-col gap-4">
    <flux:select wire:model.live="select" label="">
        <flux:select.option value="0" wire:key="role-0">Choose roles...</flux:select.option>
        @foreach ($roles as $role)
            @if(!in_array($role['id'], array_column($selected, 'id')))
                <flux:select.option value="{{ $role['id'] }}" wire:key="role-{{ $role['id'] }}">
                    {{ $role['name'] }}
                </flux:select.option>
            @endif
        @endforeach
    </flux:select>

    <div class="flex flex-row flex-wrap gap-1">
        @foreach ($selected as $s)
            <flux:badge color="indigo" wire:key="selected_role_{{ $s['id'] }}">
                {{ $s['name'] }}
                <flux:badge.close wire:click="remove({{ $s['id'] }})" />
            </flux:badge>
        @endforeach
    </div>
</div>
