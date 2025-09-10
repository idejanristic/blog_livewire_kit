<x-layouts.backend.app.sidebar :title="$title" :description="$description">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.backend.app.sidebar>
