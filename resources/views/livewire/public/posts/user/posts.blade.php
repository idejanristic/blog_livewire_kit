<section class="w-full">
    <x-app.header
        title="Blog"
        subtitle="Posts was written by {{ $user->name }}"
    />

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">
        <div class="min-h-150 w-full lg:w-2/3">
            <flux:breadcrumbs class="mb-4">
                <flux:breadcrumbs.item
                    href="{{ route('home') }}"
                    wire:navigate
                >
                    Home
                </flux:breadcrumbs.item>

                <flux:breadcrumbs.item
                    href="{{ route('posts.index') }}"
                    wire:navigate
                >
                    Blog
                </flux:breadcrumbs.item>

                <flux:breadcrumbs.item>
                    <span class="text-orange-700 dark:text-orange-400">
                        {{ $user->name }}
                    </span>
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>

            <livewire:components.posts.table
                :user="$user"
                :publishedType="$publishedType"
            />
        </div>

        <div class="w-full lg:w-1/3">
            <x-tags
                :tags="$allTags"
                :tagId="$tagId"
            />
        </div>
    </div>
</section>
