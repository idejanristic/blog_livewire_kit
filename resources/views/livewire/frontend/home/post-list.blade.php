<div class="grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16  lg:mx-0 lg:max-w-none lg:grid-cols-3">
    @foreach ($posts as $post)
        <x-posts.post :post="$post" class="flex max-w-xl flex-col items-start justify-between">

            <x-posts.date />

            <x-posts.item class="mb-6" />

            <x-posts.author :user="$post->user" />

        </x-posts.post>
    @endforeach
</div>
