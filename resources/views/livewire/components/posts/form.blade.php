<form
    wire:submit.prevent="{{ $post && $post->exists ? 'update' : 'store' }}"
    class="flex flex-col gap-6"
>
    <flux:field>
        <flux:label>Title</flux:label>
        <flux:input
            wire:model.live.debounce.500ms="form.title"
            type="text"
        />
        <flux:error name="form.title" />
    </flux:field>

    <flux:field>
        <flux:label>Excerpt</flux:label>
        <flux:textarea
            wire:model.live.debounce.500ms="form.excerpt"
            rows="2"
        />
        <flux:error name="form.excerpt" />
    </flux:field>

    <flux:field>
        <flux:label>Published on</flux:label>
        <flux:input
            wire:model="form.published_at"
            type="date"
            max="2999-12-31"
        />
        <flux:error name="form.published_at" />
    </flux:field>

    <livewire:public.tags-select
        :tags="$tags"
        :selected="collect($form->selectedTags)
            ->map(fn($id) => collect($tags)->firstWhere('id', $id))
            ->filter()
            ->values()
            ->all()"
    />

    <flux:field>
        <flux:label>Body:</flux:label>
        <flux:textarea
            wire:model.live.debounce.500ms="form.body"
            rows="8"
        />
        <flux:error name="form.body" />
    </flux:field>

    <div class="flex items-center justify-end">
        <flux:button
            variant="danger"
            type="submit"
            class="w-full"
            wire:loading.attr="disabled"
            wire:target="store,update"
        >
            {{ $post && $post->exists ? 'Edit post' : 'Add post' }}
        </flux:button>
    </div>
</form>
