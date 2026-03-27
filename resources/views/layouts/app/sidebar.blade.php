<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <!-- MENU PRINCIPAL -->
            <flux:sidebar.nav>
                <flux:sidebar.group heading="Menu Principal" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        Tableau de bord
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="cube" :href="route('marchandises.index')" :current="request()->routeIs('marchandises.*')" wire:navigate>
                        Marchandises
                    </flux:sidebar.item>
                    
                    <!-- NOUVEAU : LIEN NOTIFICATIONS AVEC PASTILLE ROUGE -->
                    <flux:sidebar.item icon="bell" :href="route('notifications.index')" :current="request()->routeIs('notifications.index')" wire:navigate class="flex items-center justify-between w-full">
                        <span>Notifications</span>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full shadow animate-pulse">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </flux:sidebar.item>

                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <!-- MENU ADMINISTRATEUR -->
            @if(auth()->user()->role === 'admin')
            <flux:sidebar.nav>
                <flux:sidebar.group heading="Administration" class="grid">
                    <flux:sidebar.item icon="users" :href="route('admin.users.index')" :current="request()->routeIs('admin.users.*')" wire:navigate>
                        Utilisateurs
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="chart-bar" :href="route('admin.rapports')" :current="request()->routeIs('admin.rapports')" wire:navigate>
                        Rapports globaux
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="exclamation-triangle" :href="route('admin.alertes')" :current="request()->routeIs('admin.alertes')" wire:navigate class="text-red-500">
                        Alertes
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>
            @endif

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full cursor-pointer text-red-600">Déconnexion</flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}
        @fluxScripts
    </body>
</html>