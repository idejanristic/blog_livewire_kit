<section class="w-full">
    <x-app.header title="Edit role" />

    <div class="mt-4 w-full">
        <livewire:components.users.roles.form
            :role="$role"
            :permissions="$permissions"
        />
    </div>
</section>
