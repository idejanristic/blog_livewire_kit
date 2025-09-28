<section class="w-full">
    <x-app.header title="All tags" />

    <div class="mt-4 gap-6">
        <div class="min-h-150 mb-4 w-full">
            @can(abilities: 'view.tag')
                <livewire:components.tags.table />
            @endcan
        </div>

        <div class="w-full lg:w-1/3">
            @can(abilities: 'create.tag')
                <livewire:components.tags.new-tag />
            @endcan
        </div>
    </div>
</section>
