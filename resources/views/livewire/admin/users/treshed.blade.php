<section class="w-full">
    <x-app.header title="Treshed users" subtitle="Manage deleted users of application" />

    <livewire:components.users.navbar />

    <div class="flex w-full flex-col mt-4">
        <livewire:components.users.table :trashedType="$type" />
    </div>
</section>
