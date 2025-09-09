<x-layouts.frontend.app.header :title="$title ?? null">
    <flux:main container>
        {{ $slot }}
    </flux:main>
</x-layouts.frontend.app.header>
