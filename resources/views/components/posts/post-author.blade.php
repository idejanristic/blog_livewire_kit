@aware(['user'])

<div {{ $attributes->merge(['class' => 'relative flex items-center gap-x-4 justify-self-end']) }}>
    @if ($user->has_profile && $user->profile->img_path)
        <flux:avatar
            circle
            src="{{ Storage::url($user->profile->img_path) }}"
        />
    @else
        <flux:avatar
            circle
            :name="$user->initials()"
        />
    @endif

    <div class="text-sm/6">
        <p class="font-semibold text-white">
            <a
                href="#"
                wire:navigate
            >
                <span class="absolute inset-0"></span>
                {{ $user->profile_title }} {{ $user->profile_name }}
            </a>
        </p>
    </div>
</div>
