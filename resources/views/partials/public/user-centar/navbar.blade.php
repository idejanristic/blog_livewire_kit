<flux:navbar class="mb-5">
    @can(abilities: 'view.post')
        <flux:navbar.item :href="route('user.center.index')" :current="request()->routeIs('user.center.index')"
            wire:navigate>
            Posts
        </flux:navbar.item>
    @endcan


    @can(abilities: 'create.post')
        <flux:navbar.item :href="route('user.posts.create')" :current="request()->routeIs('user.posts.create')"
            wire:navigate>
            New post</flux:navbar.item>
    @endcan
</flux:navbar>
