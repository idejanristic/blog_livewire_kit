<section class="w-full">
    <x-app.header
        title="Settings"
        subtitle="Manage your profile and account settings"
    />

    <x-layouts.public.settings.layout
        :heading="__('Appearance')"
        :subheading="__('Update the appearance settings for your account')"
    >
        <div class="md:w-1/2">
            <flux:radio.group
                x-data
                variant="segmented"
                x-model="$flux.appearance"
            >
                <flux:radio
                    value="light"
                    icon="sun"
                >{{ __('Light') }}</flux:radio>
                <flux:radio
                    value="dark"
                    icon="moon"
                >{{ __('Dark') }}</flux:radio>
                <flux:radio
                    value="system"
                    icon="computer-desktop"
                >{{ __('System') }}</flux:radio>
            </flux:radio.group>
        </div>
    </x-layouts.public.settings.layout>
</section>
