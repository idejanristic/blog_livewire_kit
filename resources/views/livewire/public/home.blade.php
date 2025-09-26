<section class="w-full">
    <x-app.header
        title="Demo blog"
        subtitle="Learn how to grow your business with our expert advice"
    />

    <div class="mb-4 mt-8 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach ($posts as $post)
            <x-posts.post
                wire:key="home_post_{{ $post->id }}"
                :post="$post"
                class="flex max-w-xl flex-col items-start justify-start"
            >

                <x-posts.post-date />

                <x-posts.post-item />

                @if ($post->user)
                    <x-posts.post-author :user="$post->user" />
                @endif

            </x-posts.post>
        @endforeach
    </div>
</section>
