<x-layouts.frontend.app.header :title="$title" :description="$description">
    <flux:main container>
        {{ $slot }}

        @include('partials.frontend.footer')

        @if(session()->has('toast'))
            <script>
                console.log('test toast')
                window.dispatchEvent(new CustomEvent('toast', { detail: @json(session('toast')) }));
            </script>
        @endif
    </flux:main>
</x-layouts.frontend.app.header>
