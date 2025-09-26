<section class="w-full">
    <x-app.header title="Dashboard" />

    <div class="flex mt-6 w-full min-h-150">
        <div class="flex-1 grid auto-rows-min gap-4 md:grid-cols-3">
            <x-app.card>

                <x-app.card.row class="mb-0">
                    <div class="flex h-10 w-10 items-center justify-center">
                        <x-icons.users size="10" />
                    </div>

                    @if($totalAuthorRequest > 0)
                        <flux:text color="orange">author request {{ $totalAuthorRequest }}</flux:text>
                    @endif
                </x-app.card.row>

                <flux:separator class="mt-4 mb-4" />

                <x-app.card.row class="mb-0">
                    <div class="flex-1 ">
                        <flux:link href="{{ route('admin.users.index') }}" variant="subtle" class="text-2xl font-bold">
                            Users</flux:link>

                        <div class="mt-2 opacity-70">
                            <small>
                                online {{ $onlineUsers }} of {{ $totalUsers }} users
                            </small>
                        </div>
                    </div>

                    <span
                        class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2  text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                        <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432C6.1236 1.37432 6.12391 1.37432 6.12422 1.37432C6.31631 1.37415 6.50845 1.44731 6.65505 1.59381L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z"
                                fill=""></path>
                        </svg>

                        11.01%
                    </span>
                </x-app.card.row>
            </x-app.card>
        </div>

    </div>
</section>
