<section class="w-full">
    <x-app.header title="Author requst" subtitle="Change user role to author role" />

    <div class="flex w-full flex-col mt-4">
        <livewire:components.users.table trashedType="all" :authorRequest="true" />
    </div>
</section>
