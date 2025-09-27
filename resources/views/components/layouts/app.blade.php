<x-layouts.public.header
    :title="$title"
    :description="$description"
>
    <flux:main container>
        {{ $slot }}

        <x-app.footer />
    </flux:main>
</x-layouts.public.header>
