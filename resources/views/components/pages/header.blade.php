@props(['title', 'subtitle' => ''])

<header class="lg:mx-0 my-6">
    <h1 class="text-4xl font-semibold tracking-tight text-pretty sm:text-5xl">{{ $title }}</h1>
    @if ($subtitle != '')
        <p class="mt-3 text-lg/8">{{ $subtitle }}.</p>
    @endif
</header>
