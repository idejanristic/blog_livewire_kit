<x-layouts.frontend.app.header :title="$title ?? null">
    <flux:main container>
        {{ $slot }}

        @include('partials.frontend.footer')
    </flux:main>
</x-layouts.frontend.app.header>
