@php
    $currentUser = auth()->user();
@endphp

<x-layouts.frontend.app title="User centar" description="">
    <x-pages.header title="User Centar"
        subtitle="Posts was written by {{ $currentUser->name }} ({{ $currentUser->email }})" />

    <flux:separator class="mb-3 mt-2" />

    <x-pages.user-centar-nav />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            @livewire(name: 'frontend.user.post-list', params: ['user' => auth()->user()])
        </div>
        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>
    </div>

</x-layouts.frontend.app>
