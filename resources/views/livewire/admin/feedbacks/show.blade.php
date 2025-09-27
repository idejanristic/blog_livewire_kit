<section class="w-full">
    <x-app.header
        title="Feedback"
        :subtitle="$feedback->email"
    />

    <div class="mt-6 flex w-full flex-col gap-6">
        <div class="min-h-150 w-full lg:w-1/3">
            <x-app.card>
                <x-app.card.row>
                    <flux:heading size="lg">Feedback</flux:heading>
                    <livewire:components.feedbacks.actions
                        :feedback="$feedback"
                        :key="'feedback_actions_' . $feedback->id . '_show'"
                    />
                </x-app.card.row>

                <flux:separator class="mb-2 mt-2" />

                <x-app.card.col>
                    <flux:heading>Name:</flux:heading>
                    <flux:text>
                        {{ $feedback->name }}
                    </flux:text>
                </x-app.card.col>

                <x-app.card.col>
                    <flux:heading>Email:</flux:heading>
                    <flux:text>
                        {{ $feedback->email }}
                    </flux:text>
                </x-app.card.col>

                <x-app.card.col>
                    <flux:heading>Phome:</flux:heading>
                    <flux:text>
                        {{ $feedback->phone ?? '-' }}
                    </flux:text>
                </x-app.card.col>

                <x-app.card.col>
                    <flux:heading>Created at:</flux:heading>
                    <flux:text>
                        {{ $feedback->created_at->date() ?? '-' }}
                    </flux:text>
                </x-app.card.col>

                <x-app.card.col>
                    <flux:heading>Message:</flux:heading>
                    <flux:text>
                        {{ $feedback->message }}
                    </flux:text>
                </x-app.card.col>
            </x-app.card>
        </div>
    </div>
    <livewire:components.delete-comfirmation title="feedback" />
</section>
