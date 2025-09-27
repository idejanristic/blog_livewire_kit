<section class="w-full">
    <x-app.header
        title="Contact Me"
        subtitle="Have questions? I have answers (maybe)"
    />

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">

        <div class="min-h-150 w-full lg:w-2/3">
            <p class="mb-4">
                Want to get in touch with me? Fill out the form below to send me a message and I will try to get back to
                you within 24 hours!
            </p>

            <form
                wire:submit="send"
                class="flex flex-col gap-6"
            >
                <flux:field>
                    <flux:label>Name</flux:label>
                    <flux:input
                        wire:model.live.debounce.500ms="form.name"
                        @readonly="{{ $user && $user->exists }}"
                        type="text"
                    />
                    <flux:error name="form.name" />
                </flux:field>

                <flux:field>
                    <flux:label>Email</flux:label>
                    <flux:input
                        wire:model.live.debounce.500ms="form.email"
                        @readonly="{{ $user && $user->exists }}"
                        type="email"
                    />
                    <flux:error name="form.email" />
                </flux:field>

                <flux:field>
                    <flux:label>Phone</flux:label>
                    <flux:input
                        wire:model.live.debounce.500ms="form.phone"
                        type="text"
                        mask="(999) 999-9999"
                    />
                    <flux:error name="form.phone" />
                </flux:field>

                <flux:field>
                    <flux:label>Message:</flux:label>
                    <flux:textarea
                        wire:model.live.debounce.500ms="form.message"
                        rows="8"
                    />
                    <flux:error name="form.message" />
                </flux:field>

                <div class="flex items-center justify-end">
                    <flux:button
                        variant="danger"
                        type="submit"
                        class="w-full"
                    >
                        Send
                    </flux:button>
                </div>
            </form>
        </div>

        <div class="w-full lg:w-1/3">
            <x-tags
                :tags="$allTags"
                :tagId="$tagId"
            />
        </div>
    </div>
</section>
