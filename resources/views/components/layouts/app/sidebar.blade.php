<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Dashboard')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>{{
                    __('Dashboard') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        @role('super admin')
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Pengguna')" class="grid">
                <flux:navlist.group expandable heading="Pengguna" class="grid">
                    <flux:navlist.item icon="users" :href="route('users.index')"
                        :current="request()->routeIs('users.index')" wire:navigate>{{ __('Pengguna') }}
                    </flux:navlist.item>
                    <livewire:components-livewire.link-user />
                </flux:navlist.group>
            </flux:navlist.group>
        </flux:navlist>
        @endrole

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Entry')" class="grid">
                <flux:navlist.group expandable heading="Entry" class="grid">
                    <flux:navlist.item icon="clipboard" :href="route('entry.index')"
                        :current="request()->routeIs('entry.index')" wire:navigate>{{ __('Entry') }}</flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('entry.create')"
                        :current="request()->routeIs('entry.create')" wire:navigate>{{ __('Tambah Entry') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="currency-dollar" :href="route('saldo')"
                        :current="request()->routeIs('saldo')" wire:navigate>{{ __('Saldo') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Rekap')" class="grid">
                <flux:navlist.group expandable heading="Rekap" class="grid">
                    {{-- <flux:navlist.item icon="arrow-path-rounded-square" :href="route('rekap')"
                        :current="request()->routeIs('rekap')" wire:navigate>{{ __('Rekap') }}
                    </flux:navlist.item> --}}
                    <flux:navlist.item icon="chart-pie" :href="route('rekon')"
                        :current="request()->routeIs('rekon', 'rekon.detail')" wire:navigate>{{ __('Rekon') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="archive-box" :href="route('bkubud')"
                        :current="request()->routeIs('bkubud', 'bkubud.detail')" wire:navigate>{{ __('BKUBUD') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Cetak')" class="grid">
                <flux:navlist.group expandable heading="Cetak" class="grid">
                    <flux:navlist.item icon="printer" :href="route('cetak.rekonsiliasi')"
                        :current="request()->routeIs('cetak.rekonsiliasi')" wire:navigate>{{ __('Cetak
                        Rekonsiliasi') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="chart-bar" :href="route('laporan')"
                        :current="request()->routeIs('laporan')" wire:navigate>{{ __('Perbandingan') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist.group>
        </flux:navlist>


        <flux:spacer />
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            {{-- <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio> --}}
        </flux:radio.group>

        <!-- Desktop User Menu -->
        <div class="hidden lg:block">
            <flux:dropdown position="bottom" align="start">
                <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down" />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
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


                    {{--
                    <flux:menu.separator /> --}}

                    {{-- <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.password')" icon="cog" wire:navigate>{{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group> --}}

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Keluar') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </div>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
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

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Keluar') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}


    @fluxScripts
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>