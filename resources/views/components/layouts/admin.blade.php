<x-layouts.admin.sidebar :title="$title ?? null">
    <flux:main>
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
    </flux:main>
</x-layouts.admin.sidebar>
