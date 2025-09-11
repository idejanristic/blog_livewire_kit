<x-layouts.frontend.app title="Edit post" description="form for edit post">
    <div class="w-full min-h-150 lg:w-2/3">
        <x-pages.header title="Edit post" />

        <flux:separator class="mb-6 mt-2" />

        <div class="w-full min-h-150">
            @livewire('frontend.posts.form', [
                'post' => $post,
            ])
        </div>
    </div>
</x-layouts.frontend.app>
