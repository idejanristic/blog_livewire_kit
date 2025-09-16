@php
    $currentUser = auth()->user();
@endphp
<section class="w-full">
    <x-pages.header title="Settings" subtitle="Update the appearance settings for your account" />

    <flux:separator class="mb-3 mt-2" />

    <x-pages.user-settings-nav />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
            </flux:radio.group>
        </div>
        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>
    </div>
</section>
