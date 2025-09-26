<section class="w-full">
    <x-app.header title="User Centar" subtitle="Posts was written by {{ $user->name }}" />

    <div class="flex flex-col lg:flex-row gap-6 mt-4">
        <div class="w-full min-h-150 lg:w-2/3">
            @can('create.post')
                Posts
            @else
                @if($user->author_request)
                    <x-flux::text>
                        It will take some time to allow you ability to create articles.
                    </x-flux::text>
                @else

                    <x-flux::text class="mb-4">
                        If you want to create articles on this blog, send the request. It would be nice to create your own
                        profile.
                    </x-flux::text>

                    <x-flux::button variant="danger" href="{{ route('user.center.author.request') }}">Send the
                        request</x-flux::button>

                @endif
            @endcan
        </div>

        <div class="w-full lg:w-1/3">

        </div>
    </div>
</section>
