@aware(['user'])

<div {{ $attributes->merge(['class' => 'relative flex items-center gap-x-4 justify-self-end']) }}>
    <flux:avatar
        circle
        :name="$user->initials()"
    />

    <div class="text-sm/6">
        <p class="font-semibold text-white">
            <a
                href="#"
                wire:navigate
            >
                <span class="absolute inset-0"></span>
                {{ $user->name }}
            </a>
        </p>
    </div>
</div>
