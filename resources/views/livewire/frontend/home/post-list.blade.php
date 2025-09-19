<div class="grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16  lg:mx-0 lg:max-w-none lg:grid-cols-3">
    @foreach ($posts as $post)
        <x-posts.post wire:key="home_post_{{ $post->id }}" :post="$post"
            class="flex max-w-xl flex-col items-start justify-start">

            <x-posts.date />
            <x-posts.item />
            <x-pages.tags :tags="$post->tags" class="mb-6" />
            @if($post->user)
                <x-posts.author :user="$post->user" />
            @endif

        </x-posts.post>
    @endforeach

    <x-posts.delete />
</div>
