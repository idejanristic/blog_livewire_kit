<x-layouts.public.header
    :title="$title"
    :description="$description"
>
    <flux:main container>
        {{ $slot }}

        <x-app.footer />

        @if (session()->has('toast'))
            <script>
                window.dispatchEvent(
                    new CustomEvent('toast', {
                        detail: @json(session('toast'))
                    })
                );
            </script>
        @endif
    </flux:main>
</x-layouts.public.header>
