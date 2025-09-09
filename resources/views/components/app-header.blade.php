@props(['title', 'subtitle' => ''])

<div class="max-w-2xl lg:mx-0 my-6">
    <h2 class="text-4xl font-semibold tracking-tight text-pretty sm:text-5xl">{{ $title }}</h2>
    @if ($subtitle != '')
        <p class="mt-3 text-lg/8">{{ $subtitle }}.</p>
    @endif
</div>
