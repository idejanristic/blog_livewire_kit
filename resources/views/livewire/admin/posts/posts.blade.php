<section class="w-full">
    <x-app.header title="All Posts" />

    <div class="mt-4 gap-6">
        <div class="min-h-150 mb-4 w-full">
            @canany(abilities: ['post.trash', 'post.restore'])
                <livewire:components.posts.admin.table trashedType="untrashed" />
            @endcanany
        </div>
    </div>
</section>
