<div id="commemnt_list">
    @if ($comments->count() > 0)
        <div class="mb-4">
            <flux:text size="lg">
                Commensts:
            </flux:text>
        </div>
        @foreach ($comments as $comment)
            <x-comment
                wire:key="{{ $comment->id }}"
                :comment="$comment"
            />
        @endforeach
    @endif
</div>
