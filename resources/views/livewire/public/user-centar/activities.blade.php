<section class="w-full">
    <x-app.header
        title="User Centar"
        subtitle="Activites by {{ $user->profile_name }}"
    />

    @include('partials.public.user-centar.navbar')

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">
        <div class="min-h-150 w-full lg:w-2/3">
            <livewire:components.users.activities :user="$user" />
        </div>

        <div class="w-full lg:w-1/3">
            <x-tags
                :tags="$allTags"
                :tagId="$tagId"
            />
        </div>
    </div>

</section>
