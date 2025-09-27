<section class="w-full">
    <x-app.header
        title="User Centar"
        subtitle="Posts was written by {{ $user->name }}"
    />

    @include('partials.public.user-centar.navbar')

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">
        <div class="min-h-150 w-full lg:w-2/3">
            @can(abilities: 'create.post')
                <livewire:components.posts.table
                    :user="$user"
                    :publishedType="$publishedType"
                    :showTabs="true"
                />
            @else
                @if ($user->author_request)
                    <x-flux::text>
                        It will take some time to allow you ability to create articles.
                    </x-flux::text>
                @else
                    <x-flux::text class="mb-4">
                        If you want to create articles on this blog, send the request. It would be nice to create your own
                        profile.
                    </x-flux::text>

                    <x-flux::button
                        variant="danger"
                        href="{{ route('user.center.author.request') }}"
                    >
                        Send the request
                    </x-flux::button>
                @endif
            @endcan
        </div>

        <div class="w-full lg:w-1/3">
            <x-tags
                :tags="$allTags"
                :tagId="$tagId"
            />
        </div>
    </div>
</section>
