{{-- @var \App\Models\User $user --}}
@aware(['user'])

<div {{ $attributes->merge(['class' => 'relative flex items-center gap-x-4 justify-self-end']) }}>
    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
        alt="" class="size-10 rounded-full bg-gray-800" />
    <div class="text-sm/6">
        <p class="font-semibold text-white">
            <a href="{{ route('posts.user', ['user' => $user->id]) }}" wire:navigate>
                <span class="absolute inset-0"></span>
                {{ $user->profile_title}} {{ $user->profile_name }}
            </a>
        </p>
        {{-- <p class="text-gray-400">Co-Founder / CTO</p> --}}
    </div>
</div>
