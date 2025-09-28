<section class="w-full">
    <x-app.header
        title="Author requst"
        subtitle="Change user role to author role"
    />

    <div class="mt-4 flex w-full flex-col">
        <livewire:components.users.table
            trashedType="all"
            :authorRequest="true"
        />
    </div>
</section>
