<x-layouts.auth.simple :title="$title ?? null">
    {{ $slot }}

    @if (session()->has('toast'))
        <script>
            window.dispatchEvent(
                new CustomEvent('toast', {
                    detail: @json(session('toast'))
                })
            );
        </script>
    @endif
</x-layouts.auth.simple>
