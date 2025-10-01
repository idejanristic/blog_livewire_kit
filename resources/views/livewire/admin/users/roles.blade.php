<section class="w-full">
    <x-app.header
        title="All roles"
        subtitle="Manage all role of user"
    />


    <div class="mt-4 flex w-full flex-col">
        <livewire:components.users.roles.table />

        <div>
            <flux:button
                color="green"
                variant="primary"
                href="{{ route('admin.users.roles.create') }}"
            >New role</flux:button>
        </div>
    </div>
</section>
