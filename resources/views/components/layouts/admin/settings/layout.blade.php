<div class="flex flex-col max-md:flex-col">
    <div class="me-10 mb-4 w-full pb-4 md:w-[220px]">
        <flux:navbar>
            <flux:navbar.item :href="route('admin.settings.profile')"
                :current="request()->routeIs('admin.settings.profile')" wire:navigate>{{ __('Profile') }}
            </flux:navbar.item>
            <flux:navbar.item :href="route('admin.settings.password')"
                :current="request()->routeIs('admin.settings.password')" wire:navigate>{{ __('Password') }}
            </flux:navbar.item>
            <flux:navbar.item :href="route('admin.settings.appearance')"
                :current="request()->routeIs('admin.settings.appearance')" wire:navigate>{{ __('Appearance') }}
            </flux:navbar.item>
        </flux:navbar>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-6 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
