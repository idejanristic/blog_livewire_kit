@props(['title', 'subtitle' => ''])

<div class="relative mb-2 w-full">
    <flux:heading size="xl" level="1">{{ $title }}</flux:heading>
    @if ($subtitle != '')
        <flux:subheading size="lg">{{ $subtitle }}</flux:subheading>
    @endif
    <flux:separator variant="subtle" class="mt-6" />
</div>
