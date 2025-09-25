<flux:navbar class="mb-5">
    @foreach ($data as $d)
        <flux:navbar.item :href="route($d->route())" :current="request()->routeIs($d->route().'*')" wire:navigate>
            {{ $d->label() }}
        </flux:navbar.item>
    @endforeach
</flux:navbar>
