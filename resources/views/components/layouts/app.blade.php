<x-layouts.public.header :title="$title" :description="$description">
    <flux:main container>
        {{ $slot }}
    </flux:main>
</x-layouts.public.header>
