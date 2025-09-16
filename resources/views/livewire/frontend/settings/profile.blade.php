@php
    $profile = $this->user->profile;
@endphp

<section class="w-full">
    <x-pages.header title="Settings" subtitle="{{ $this->user->name }} ({{ $this->user->email }})" />

    <flux:separator class="mb-3 mt-2" />

    <x-pages.user-settings-nav />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            <div class="relative mb-5">
                <flux:heading size="xl">Profile</flux:heading>
            </div>

            <form wire:submit="{{ $profile && $profile->exists ? 'update' : 'store' }}"
                class="flex flex-col gap-6 mb-6">
                <flux:field>
                    <flux:label>First name</flux:label>
                    <flux:input wire:model.live.debounce.500ms="form.first_name" type="text" />
                    <flux:error name="form.first_name" />
                </flux:field>
                <flux:field>
                    <flux:label>Last name</flux:label>
                    <flux:input wire:model.live.debounce.500ms="form.last_name" type="text" />
                    <flux:error name="form.last_name" />
                </flux:field>

                <flux:field>
                    <flux:label>Title</flux:label>
                    <flux:input wire:model.live.debounce.500ms="form.title" type="text" />
                    <flux:error name="form.title" />
                </flux:field>

                <div class="flex items-center justify-start">
                    <flux:button variant="primary" type="submit">
                        {{ $profile && $profile->exists ? 'Edit' : 'Save' }}
                    </flux:button>
                </div>
            </form>

            @if ($profile && $profile->exists)
                <div class="relative mb-5">
                    <flux:heading>Delete profile</flux:heading>
                </div>

                <flux:modal.trigger name="confirm-profile-deletion">
                    <flux:button variant="danger">
                        Delete profile
                    </flux:button>
                </flux:modal.trigger>

                <flux:modal name="confirm-profile-deletion" class="max-w-lg">
                    <form method="POST" wire:submit="delete" class="space-y-6">
                        <div>
                            <flux:heading size="lg">Are you sure you want to delete your profile?</flux:heading>
                        </div>

                        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                            <flux:modal.close>
                                <flux:button variant="filled">Close</flux:button>
                            </flux:modal.close>

                            <flux:button variant="danger" type="submit">Delete</flux:button>
                        </div>
                    </form>
                </flux:modal>
            @endif
        </div>
    </div>
</section>
