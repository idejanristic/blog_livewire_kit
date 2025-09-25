<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.public.head', [
        'author' => $author,
        'title' => $title,
        'description' => $description
    ])
</head>

@php
    $currentUser = auth()->user();
@endphp

<body class="min-h-screen bg-white dark:bg-zinc-900">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-3" inset="left" />

        <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0"
            wire:navigate>
            <x-app.logo />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                Home
            </flux:navbar.item>
            <flux:navbar.item icon="clipboard-document-list" :href="route('posts.index')"
                :current="request()->routeIs('posts.*')" wire:navigate>
                Blog
            </flux:navbar.item>
            <flux:navbar.item icon="user" :href="route('about')" :current="request()->routeIs('about')" wire:navigate>
                About
            </flux:navbar.item>
            <flux:navbar.item icon="inbox" :href="route('contact')" :current="request()->routeIs('contact')"
                wire:navigate>
                Contact
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
            aria-label="Toggle dark mode" />

        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <!-- Desktop User Menu -->
                    <flux:dropdown position="top" align="end">
                        <flux:profile class="cursor-pointer" :initials="$currentUser->initials()"  />

                        <flux:menu>
                            <flux:menu.radio.group>
                                <div class="p-0 text-sm font-normal">
                                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                            <span
                                                class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                                {{ $currentUser->initials() }}
                                            </span>
                                        </span>

                                        <div class="grid flex-1 text-start text-sm leading-tight">
                                            <span class="truncate font-semibold">{{ $currentUser->name }}</span>
                                            <span class="truncate text-xs">{{ $currentUser->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <flux:menu.radio.group>
                                <flux:menu.item :href="route('user.center.index')" icon="building-office" wire:navigate>
                                    User Centar
                                </flux:menu.item>
                            </flux:menu.radio.group>

                             @can(abilities: 'admin.access')
                                <flux:menu.item :href="route('admin.dashboard')" icon="layout-grid" wire:navigate>
                                    {{ __('Dashboard') }}
                                </flux:menu.item>
                            @endcan

                            <flux:menu.separator />

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                    {{ __('Log Out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                @else
                    <flux:dropdown>
                        <flux:navbar.item icon:trailing="chevron-down">Account</flux:navbar.item>
                        <flux:navmenu>
                            <flux:navmenu.item href="{{ route('login') }}" icon="arrow-right-end-on-rectangle" wire:navigate>
                                Login
                            </flux:navmenu.item>
                            @if (Route::has('register'))
                                <flux:navmenu.item href="{{ route('register') }}" icon="arrow-right-start-on-rectangle"
                                    wire:navigate>Register
                                </flux:navmenu.item>
                            @endif
                        </flux:navmenu>
                    </flux:dropdown>
                @endauth
            </nav>
        @endif

    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('home') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app.logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">

                <flux:navlist.item icon="home" :href="route('home')" :current="request()->routeIs('home')"
                    wire:navigate>
                    {{ __('Home') }}
                </flux:navlist.item>

                <flux:navlist.item icon="clipboard-document-list" :href="route('posts.index')"
                    :current="request()->routeIs('posts.index')" wire:navigate>
                    Blog
                </flux:navlist.item>

                <flux:navlist.item icon="user" :href="route('about')" :current="request()->routeIs('about')"
                    wire:navigate>
                    About
                </flux:navlist.item>

                <flux:navlist.item icon="inbox" :href="route('contact')" :current="request()->routeIs('contact')"
                    wire:navigate>
                    Contact
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />


    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>

</html>
