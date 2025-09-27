<section class="w-full">
    <x-app.header
        title="{{ $post->title }}"
        subtitle="{{ $post->excerpt }}"
    />

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">
        <div class="min-h-150 w-full lg:w-2/3">
            <div class="mb-4 flex items-center justify-between">
                <flux:breadcrumbs class="mb-4 flex-1">
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
                            Post</span>
                    </flux:breadcrumbs.item>
                </flux:breadcrumbs>
                @auth
                    <livewire:components.posts.actions
                        :post="$post"
                        :key="'post_actions_' . $post->id . '_show'"
                    />
                @endauth
            </div>

            <livewire:components.posts.meta
                :post="$post"
                :show-user-link="true"
            />

            <div class="my-4">
                {{ $post->body }}
            </div>
        </div>

        <div class="w-full lg:w-1/3">

        </div>

        <livewire:components.posts.delete-confirmation />
    </div>
</section>
