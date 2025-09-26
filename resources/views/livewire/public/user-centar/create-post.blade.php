<section class="w-full">
    <x-app.header
        title="User Centar"
        subtitle="Create a new post"
    />

    @include('partials.public.user-centar.navbar')

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">
        <div class="min-h-150 w-full lg:w-2/3">
            <livewire:components.posts.form />
        </div>
        <div class="w-full lg:w-1/3">

        </div>
    </div>
</section>
