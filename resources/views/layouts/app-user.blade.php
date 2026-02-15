<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=satoshi@300,400,500,700,900&display=swap">
    
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Styles --}}
    @livewireStyles
</head>
<body class="font-satoshi antialiased bg-brand-cream text-brand-dark">
    <div class="flex min-h-screen overflow-hidden">
        {{-- Sidebar --}}
        <aside class="hidden lg:flex flex-col w-72 bg-brand-dark text-white p-6 sticky top-0 h-screen">
            <div class="flex items-center gap-3 mb-10 px-2">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto brightness-0 invert" alt="Logo">
                <span class="text-xl font-black tracking-tighter">Furniqo</span>
            </div>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 {{ Request::is('dashboard') ? 'bg-brand-orange text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span class="font-bold">Overview</span>
                </a>
                <a href="{{ route('shopping-cart') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 {{ Request::is('shopping-cart') ? 'bg-brand-orange text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <span class="font-bold">My Orders</span>
                </a>
                <a href="{{ route('wishlist') }}" 
                   class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300 {{ Request::is('wishlist') ? 'bg-brand-orange text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <span class="font-bold">Wishlist</span>
                </a>
            </nav>

            <div class="mt-auto space-y-4">
                <div class="p-5 rounded-3xl bg-white/5 border border-white/10 space-y-3">
                    <p class="text-[10px] uppercase tracking-widest font-black text-brand-orange">Upgrade Account</p>
                    <p class="text-xs text-zinc-400 leading-relaxed">Join Furniqo Plus for free delivery & workshops.</p>
                    <button class="w-full py-2.5 bg-brand-orange text-white text-xs font-black rounded-xl hover:scale-105 transition-transform uppercase">Go Pro</button>
                </div>

                <div class="flex items-center gap-4 px-2 py-4 border-t border-white/10">
                    <div class="w-10 h-10 rounded-full bg-brand-orange flex items-center justify-center font-black text-white italic">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-black truncate">{{ Auth::user()->first_name }}</p>
                        <p class="text-[10px] text-zinc-500 uppercase font-black truncate">Member</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" @click.prevent="$root.submit();" class="text-zinc-500 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
            {{-- Top Navbar Mobile --}}
            <header class="lg:hidden flex items-center justify-between p-6 bg-white border-b border-brand-peach">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-6 w-auto" alt="Logo">
                    <span class="text-lg font-black tracking-tighter">Furniqo</span>
                </div>
                <button class="p-2 rounded-xl bg-brand-cream border border-brand-peach text-brand-dark">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
            </header>

            {{-- Top Action Bar Desktop --}}
            <div class="hidden lg:flex items-center justify-between px-10 py-8 sticky top-0 z-20 bg-brand-cream/80 backdrop-blur-md">
                <div>
                    <h2 class="text-3xl font-black text-brand-dark tracking-tighter">@yield('dashboard_title', 'Overview')</h2>
                    <p class="text-sm text-zinc-400 mt-1">Welcome back, {{ Auth::user()->first_name }}! Here's what's happening today.</p>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing') }}" class="flex items-center gap-2 px-6 py-3 bg-white border border-brand-peach rounded-2xl hover:bg-white/50 transition-all group">
                        <svg class="w-4 h-4 text-brand-orange group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span class="text-sm font-black uppercase tracking-widest text-brand-dark">Back to Store</span>
                    </a>
                </div>
            </div>

            {{-- Page Content Slot --}}
            <div class="px-6 lg:px-10 pb-10">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('modals')
    @livewireScripts
</body>
</html>
