<div class="grid auto-rows-min gap-4 md:grid-cols-3">

    <x-pages.backend.info-card :count="$this->users()" color="blue">
        <x-slot:icon>
            <x-icons.users size="10" />
        </x-slot:icon>
        <x-slot:title>
            Users
        </x-slot:title>
        <x-slot:footer>
            <x-flux::link href="#" variant="subtle"><span class="text-blue-400">view details</span></x-flux::link>
        </x-slot:footer>
    </x-pages.backend.info-card>

    <x-pages.backend.info-card :count="$this->posts()" color='green'>
        <x-slot:icon>
            <x-icons.posts size="10" />
        </x-slot:icon>
        <x-slot:title>
            Posts
        </x-slot:title>
        <x-slot:footer>
            <x-flux::link href="#" variant="subtle"><span class="text-green-400">view details</span></x-flux::link>
        </x-slot:footer>
    </x-pages.backend.info-card>

    <x-pages.backend.info-card :count="$this->comments()" color="orange">
        <x-slot:icon>
            <x-icons.comments size="10" />
        </x-slot:icon>
        <x-slot:title>
            Comments
        </x-slot:title>
        <x-slot:footer>
            <x-flux::link href="#" variant="subtle"><span class="text-orange-400">view details</span></x-flux::link>
        </x-slot:footer>
    </x-pages.backend.info-card>


</div>
