<div class="flex flex-col gap-4">
    <flux:select
        wire:model.live="select"
        label="Tags"
    >
        <flux:select.option
            value="0"
            wire:key="tag-0"
        >Choose tags...</flux:select.option>
        @foreach ($tags as $tag)
            @if (!in_array($tag['id'], array_column($selected, 'id')))
                <flux:select.option
                    value="{{ $tag['id'] }}"
                    wire:key="tag-{{ $tag['id'] }}"
                >
                    {{ $tag['name'] }}
                </flux:select.option>
            @endif
        @endforeach
    </flux:select>

    <div class="flex flex-row flex-wrap gap-1">
        @foreach ($selected as $s)
            <flux:badge
                color="indigo"
                wire:key="selected_tag_{{ $s['id'] }}"
            >
                {{ $s['name'] }}
                <flux:badge.close wire:click="remove({{ $s['id'] }})" />
            </flux:badge>
        @endforeach
    </div>
</div>
