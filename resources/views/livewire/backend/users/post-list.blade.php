<div class="relative">
    <div class="mb-4 lg:w-1/3" wire:offline.remove>
        <flux:input wire:model.live.debounce.300ms="search" icon="magnifying-glass" placeholder="Search..." />
    </div>

    @empty($posts)
        There are no posts.
    @else
        <table class="w-full text-sm text-left mb-4">
            <thead class="text-xs uppercase border-b-4 dark:border-zinc-700 ">
                <tr>
                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'id',
                        'displayName' => 'ID',
                    ])

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'title',
                        'displayName' => 'Title',
                    ])

                    <th scope="col" class="px-4 py-3">Active</th>
                    <th scope="col" class="px-4 py-3">Info</th>

                    @include('partials.frontend.table-sortable-th', [
                        'name' => 'published_at',
                        'displayName' => 'Published on',
                    ])
                    <th scope="col" class="px-4 py-3">Action</th>
                    </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr wire:key="{{ $post->id }}" class="border-b dark:border-zinc-700">
                        <td class="px-4 py-3">{{ $post->id}}</td>
                        <td class="px-4 py-3">{{ $post->title}}</td>
                        <td class="px-4 py-3">
                            @if($post->active)
                                <x-icons.check class="text-green-500"  />
                            @else
                                <x-icons.close class="text-red-500" />
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-row gap-3">
                                <flux:text  class="dark:text-white text-zinc-900 font-bold flex gap-1">
                                    {{ $post->like_count }}
                                    <x-icons.like />
                                </flux:text>

                                <flex:text  class="dark:text-white text-zinc-900 font-bold flex gap-1">
                                    {{ $post->dislike_count }}
                                    <x-icons.dislike />
                                </flex:text>

                                <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
                                    {{ $post->comments_count }}
                                    <x-icons.comment />
                                </flux:text>

                                <flux:text class="dark:text-white text-zinc-900 font-bold flex gap-1">
                                    {{ $post->view_count }} views
                                </flux:text>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $post->published_at->format('M d Y') }}</td>
                        <td class="px-4 py-3">
                            <flux:dropdown position="bottom" align="end">

                                <flux:button icon="ellipsis-vertical" size="sm" />

                                <flux:navmenu>
                                     <flux:navmenu.item href="#" icon="clipboard-document">
                                        Publishe
                                    </flux:navmenu.item>

                                    <flux:navmenu.item href="{{ route('posts.show', ['post' => $post->id]) }}" icon="book-open" wire:navigate>
                                        Preview
                                    </flux:navmenu.item>

                                    <flux:navmenu.item href="{{ route('user.posts.edit', ['post' => $post->id]) }}" icon="pencil-square"
                                        wire:navigate>
                                        Edit</flux:navmenu.item>

                                    <flux:menu.separator />

                                    <flux:navmenu.item href="#" icon="trash">
                                        Delete
                                    </flux:navmenu.item>
                                </flux:navmenu>

                            </flux:dropdown>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            {{ $posts->links('pagination::tailwind') }}

            <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="absolute top-0 z-100 left-0 w-full h-full">
                <x-spinner />
            </div>
    @endempty
</div>

