@props(['title' => 'title', 'subtitle' => ''])

<div {{ $attributes->merge(['class' => 'relative mb-0 w-full']) }}>
    <flux:heading size="xl" level="1">{{ $title }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ $subtitle }}</flux:subheading>
    <flux:separator variant="subtle" />
</div>
