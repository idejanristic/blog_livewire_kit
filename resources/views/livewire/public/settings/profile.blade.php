<section class="w-full">
    <x-app.header
        title="Settings"
        subtitle="Manage your profile"
    />

    <x-layouts.public.settings.layout
        :heading="__('Profile')"
        :subheading="__('Update your profile')"
    >
        <div class="fles-row flex">
            <div class="min-h-150 w-full lg:w-1/2">
                <form
                    wire:submit="{{ $profile && $profile->exists ? 'update' : 'store' }}"
                    class="mb-6 flex flex-col gap-6"
                >
                    <flux:input
                        type="file"
                        wire:model="form.image"
                        label="Logo"
                    />

                    <flux:field>
                        <flux:label>First name</flux:label>
                        <flux:input
                            wire:model.live.debounce.500ms="form.first_name"
                            type="text"
                        />
                        <flux:error name="form.first_name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Last name</flux:label>
                        <flux:input
                            wire:model.live.debounce.500ms="form.last_name"
                            type="text"
                        />
                        <flux:error name="form.last_name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Title</flux:label>
                        <flux:input
                            wire:model.live.debounce.500ms="form.title"
                            type="text"
                        />
                        <flux:error name="form.title" />
                    </flux:field>

                    <div class="flex items-center justify-start">
                        <flux:button
                            variant="primary"
                            type="submit"
                        >
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

                    <flux:modal
                        name="confirm-profile-deletion"
                        class="max-w-lg"
                    >
                        <form
                            method="POST"
                            wire:submit="delete"
                            class="space-y-6"
                        >
                            <div>
                                <flux:heading size="lg">Are you sure you want to delete your profile?
                                </flux:heading>
                            </div>

                            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                                <flux:modal.close>
                                    <flux:button variant="filled">Close</flux:button>
                                </flux:modal.close>

                                <flux:button
                                    variant="danger"
                                    type="submit"
                                >Delete</flux:button>
                            </div>
                        </form>
                    </flux:modal>
                @endif
            </div>
            <div class="w-full px-8 lg:w-1/2">
                @if ($form->image || ($profile && $profile->exists && $profile->img_path))
                    <div class="relative">
                        <flux:heading size="xl">Profile image</flux:heading>
                    </div>
                    <img
                        src="{{ isset($profile->img_path) ? Storage::url($profile->img_path) : $form->image->temporaryUrl() }}"
                        alt='tmp'
                        class="blosk mt-2 w-1/4 rounded"
                    />
                @endif
            </div>
        </div>
    </x-layouts.public.settings.layout>
</section>
