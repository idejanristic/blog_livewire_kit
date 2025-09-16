@php
    $currentUser = auth()->user();
@endphp
<section class="w-full">
    <x-pages.header title="Settings" subtitle="Update the appearance settings for your account" />

    <flux:separator class="mb-3 mt-2" />

    <x-pages.user-settings-nav />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            <div class="relative mb-5">
                <flux:heading size="xl">Appearance</flux:heading>
            </div>
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
            </flux:radio.group>
        </div>

    </div>
</section>
