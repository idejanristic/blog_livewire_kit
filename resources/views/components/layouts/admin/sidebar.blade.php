<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="dark"
>

<head>
    @include('partials.admin.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar
        sticky
        stashable
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900"
    >
        <flux:sidebar.toggle
            class="lg:hidden"
            icon="x-mark"
        />

        <a
            href="{{ route('home') }}"
            class="me-5 flex items-center space-x-2 rtl:space-x-reverse"
            wire:navigate
        >
            <x-app.logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group
                :heading="__('Platform')"
                class="grid"
            >
                <flux:navlist.item
                    icon="home"
                    :href="route('admin.dashboard')"
                    :current="request()->routeIs('admin.dashboard')"
                    wire:navigate
                >
                    {{ __('Dashboard') }}
                </flux:navlist.item>

                @canany(abilities: ['post.trash', 'post.restore'])
                    <flux:navlist.group
                        expandable
                        heading="Posts"
                        class="grid"
                    >
                        <flux:navlist.item
                            icon="clipboard-document-list"
                            :href="route('admin.posts.index')"
                            :current="request()->routeIs('admin.posts.index')"
                            wire:navigate
                        >
                            Posts
                        </flux:navlist.item>
                        @can(abilities: 'post.restore')
                            <flux:navlist.item
                                icon="trash"
                                :href="route('admin.posts.trashed')"
                                :current="request()->routeIs('admin.posts.trashed*')"
                                wire:navigate
                            >
                                Trashed
                            </flux:navlist.item>
                        @endcan
                    </flux:navlist.group>
                @endcan

                @can(abilities: 'user.menage')
                    <flux:navlist.group
                        expandable
                        heading="Users"
                        class="grid"
                    >
                        <flux:navlist.item
                            icon="users"
                            :href="route('admin.users.index')"
                            :current="request()->routeIs('admin.users.index')"
                            wire:navigate
                        >
                            Users
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="user-circle"
                            :href="route('admin.users.roles')"
                            :current="request()->routeIs('admin.users.roles*')"
                            wire:navigate
                        >
                            Roles
                        </flux:navlist.item>

                        @can(abilities: 'post.publish')
                            @if ($totalAuthroRequest > 0)
                                <flux:navlist.item
                                    icon="arrow-path-rounded-square"
                                    :href="route('admin.author.request')"
                                    badge="{{ $totalAuthroRequest }}"
                                    badge:color="orange"
                                    :current="request()->routeIs('admin.author.request')"
                                    wire:navigate
                                >
                                    Author request
                                </flux:navlist.item>
                            @else
                                <flux:navlist.item
                                    icon="arrow-path-rounded-square"
                                    :href="route('admin.author.request')"
                                    :current="request()->routeIs('admin.author.request')"
                                    wire:navigate
                                >
                                    Author request
                                </flux:navlist.item>
                            @endif
                        @endcan

                    </flux:navlist.group>
                @endcan

                @canany(abilities: ['create.tag', 'update.tag', 'view.tag'])
                    <flux:navlist.item
                        icon="tag"
                        :href="route('admin.tags.index')"
                        :current="request()->routeIs('admin.tags.*')"
                        wire:navigate
                    >
                        Tags
                    </flux:navlist.item>
                @endcanany

                <flux:navlist.item
                    icon="chat-bubble-left-right"
                    :href="route('admin.comments.index')"
                    :current="request()->routeIs('admin.comments.*')"
                    wire:navigate
                >
                    Comments
                </flux:navlist.item>

                <flux:navlist.item
                    icon="document-text"
                    :href="route('admin.feedbacks.index')"
                    :current="request()->routeIs('admin.feedbacks.*')"
                    wire:navigate
                >
                    Feeebaks
                </flux:navlist.item>


            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item
                icon="folder-git-2"
                href="https://github.com/laravel/livewire-starter-kit"
                target="_blank"
            >
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item
                icon="book-open-text"
                href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank"
            >
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>

        <!-- Desktop User Menu -->
        <flux:dropdown
            class="hidden lg:block"
            position="bottom"
            align="start"
        >
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item
                        :href="route('admin.settings.profile')"
                        icon="cog"
                        wire:navigate
                    >
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="w-full"
                >
                    @csrf
                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full"
                    >
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle
            class="lg:hidden"
            icon="bars-3"
            inset="left"
        />

        <flux:spacer />

        <flux:dropdown
            position="top"
            align="end"
        >
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item
                        :href="route('admin.settings.profile')"
                        icon="cog"
                        wire:navigate
                    >
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="w-full"
                >
                    @csrf
                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full"
                    >
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
