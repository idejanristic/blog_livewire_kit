<flux:navbar class="mb-5">
    <flux:navbar.item :href="route('user.center.show')" :current="request()->routeIs('user.center.show')" wire:navigate>
        Post List
    </flux:navbar.item>

    <flux:navbar.item :href="route('user.posts.create')" :current="request()->routeIs('user.posts.create')"
        wire:navigate>
        New post</flux:navbar.item>

    <flux:navbar.item :href="route('user.center.activity')" :current="request()->routeIs('user.center.activity')"
        wire:navigate>
        Activites
    </flux:navbar.item>
</flux:navbar>
