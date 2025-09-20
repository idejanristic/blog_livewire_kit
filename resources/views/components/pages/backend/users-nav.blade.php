@props(['user'])

<flux:navbar class="mb-5">
    <flux:navbar.item :href="route('backend.users.show', ['user' => $user->id])"
        :current="request()->routeIs('backend.users.show', ['user' => $user->id])" wire:navigate>
        User
    </flux:navbar.item>

    <flux:navbar.item :href="route('backend.users.permission', ['user' => $user->id])"
        :current="request()->routeIs('backend.users.permission', ['user' => $user->id])" wire:navigate>
        Permissions
    </flux:navbar.item>

    <flux:navbar.item :href="route('backend.users.posts', ['user' => $user->id])"
        :current="request()->routeIs('backend.users.posts', ['user' => $user->id])" wire:navigate>
        Posts
    </flux:navbar.item>

    <flux:navbar.item :href="route('backend.users.comments', ['user' => $user->id])"
        :current="request()->routeIs('backend.users.comments', ['user' => $user->id])" wire:navigate>
        Comments
    </flux:navbar.item>

</flux:navbar>
