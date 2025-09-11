@props(['post', 'page' => 0])

<div {{ $attributes->merge(['class' => 'mb-8']) }}>
    {{ $slot }}
</div>
