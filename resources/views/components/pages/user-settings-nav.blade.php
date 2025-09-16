<flux:navbar class="mb-5">
    <flux:navbar.item :href="route('settings.account')" :current="request()->routeIs('settings.account')" wire:navigate>
        Account
    </flux:navbar.item>
    <flux:navbar.item :href="route('settings.profile')" :current="request()->routeIs('settings.profile')" wire:navigate>
        Profile
    </flux:navbar.item>
    <flux:navbar.item :href="route('settings.password')" :current="request()->routeIs('settings.password')"
        wire:navigate>
        Password
    </flux:navbar.item>
    <flux:navbar.item :href="route('settings.appearance')" :current="request()->routeIs('settings.appearance')"
        wire:navigate>
        Appearance</flux:navbar.item>
</flux:navbar>
