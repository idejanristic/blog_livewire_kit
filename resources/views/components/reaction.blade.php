<div {{ $attributes->merge(['class' => 'flex space-x-4']) }}>
    <button type="button" class="flex items-center space-x-2 rounded-2xl transition">
        <x-icons.like />
    </button>

    <button type="button" class="flex items-center space-x-2 rounded-2xl transition">
        <x-icons.dislike />
    </button>
</div>
