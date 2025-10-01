<section class="w-full">
    <x-app.header title="Create a new role" />

    <div class="mt-4 flex w-full flex-col">
        <livewire:components.users.roles.form :permissions="$permissions" />
    </div>
</section>
