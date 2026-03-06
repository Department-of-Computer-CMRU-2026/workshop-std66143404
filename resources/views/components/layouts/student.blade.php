<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            [v-cloak] { display: none !important; }
            .student-gradient {
                background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.08), transparent 40%),
                            radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.05), transparent 40%);
            }
        </style>
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-[#09090b] text-zinc-900 dark:text-zinc-100 font-sans antialiased student-gradient">
        {{-- Simplified Student Header --}}
        <flux:header sticky class="bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-zinc-200 dark:border-zinc-800 px-6 py-4">
            <div class="max-w-7xl mx-auto w-full flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <x-app-logo class="size-9" href="{{ route('dashboard') }}" wire:navigate />
                    <flux:heading size="lg" class="hidden sm:block font-black tracking-tight">Workshop <span class="text-indigo-600">Portal</span></flux:heading>
                </div>

                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-6">
                        <flux:link href="{{ route('dashboard') }}" wire:navigate icon="home" variant="ghost">Dashboard</flux:link>
                        <flux:link href="{{ route('events') }}" wire:navigate icon="calendar" variant="ghost">Workshops</flux:link>
                    </nav>

                    <flux:separator vertical class="hidden md:block h-6" />

                    <flux:dropdown position="top" align="end">
                        <flux:profile
                            :initials="auth()->user()->initials()"
                            icon-trailing="chevron-down"
                            class="cursor-pointer hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors p-1 rounded-lg"
                        />

                        <flux:menu>
                            <div class="p-2 border-b border-zinc-100 dark:border-zinc-800 mb-1">
                                <div class="font-bold text-sm">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-zinc-500">{{ auth()->user()->email }}</div>
                            </div>
                            
                            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>Settings</flux:menu.item>
                            
                            <flux:menu.separator />

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-left">
                                    Log out
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </flux:header>

        <main class="relative z-10">
            {{ $slot }}
        </main>

        <footer class="mt-20 border-t border-zinc-200 dark:border-zinc-800 py-12 px-6">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 opacity-50 text-sm">
                <p>&copy; {{ date('Y') }} Workshop Registration System. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-indigo-600 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-indigo-600 transition-colors">Terms of Service</a>
                </div>
            </div>
        </footer>

        @fluxScripts
    </body>
</html>
