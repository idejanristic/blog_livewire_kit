<div class="flex flex-col">
    <div class="mb-4 w-full pb-4">
        <flux:navbar>
            <flux:navbar.item
                :href="route('settings.account')"
                :current="request()->routeIs('settings.account')"
                wire:navigate
            >{{ __('Account') }}
            </flux:navbar.item>
            <flux:navbar.item
                :href="route('settings.profile')"
                :current="request()->routeIs('settings.profile')"
                wire:navigate
            >{{ __('Profile') }}
            </flux:navbar.item>
            <flux:navbar.item
                :href="route('settings.password')"
                :current="request()->routeIs('settings.password')"
                wire:navigate
            >{{ __('Password') }}
            </flux:navbar.item>
            <flux:navbar.item
                :href="route('settings.appearance')"
                :current="request()->routeIs('settings.appearance')"
                wire:navigate
            >{{ __('Appearance') }}
            </flux:navbar.item>
        </flux:navbar>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex flex-col">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-6 flex w-full flex-col">
            {{ $slot }}
        </div>
    </div>
</div>
