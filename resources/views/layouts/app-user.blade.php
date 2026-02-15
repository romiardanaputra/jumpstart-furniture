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
        <aside class="hidden lg:flex flex-col w-72 bg-brand-dark text-white p-6 sticky top-0 h-screen shadow-2xl">
            <div class="flex items-center gap-3 mb-10 px-2 group cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-brand-orange flex items-center justify-center shadow-lg shadow-brand-orange/20 group-hover:scale-110 transition-transform duration-500">
                    <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-6 w-auto brightness-0 invert" alt="Logo">
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black tracking-tighter leading-none">Furniqo</span>
                    <span class="text-[8px] uppercase tracking-[0.3em] text-brand-orange font-black">Elite Member</span>
                </div>
            </div>

            <nav class="flex-1 space-y-2">
                @php
                    $menuItems = [
                        ['route' => 'dashboard', 'label' => 'Overview', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'shopping-cart', 'label' => 'My Orders', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                        ['route' => 'wishlist', 'label' => 'Wishlist', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group
                              {{ Request::is($item['route'].'*') 
                                 ? 'bg-brand-orange text-white shadow-lg shadow-brand-orange/20' 
                                 : 'text-zinc-500 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-colors {{ Request::is($item['route'].'*') ? 'text-white' : 'text-zinc-600 group-hover:text-brand-orange' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        <span class="text-sm font-bold tracking-tight">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto space-y-4">
                {{-- Premium Upsell --}}
                <div class="p-5 rounded-3xl bg-white/5 border border-white/10 space-y-3 relative overflow-hidden group hover:border-brand-orange/30 transition-colors">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-brand-orange/10 rounded-full blur-xl group-hover:bg-brand-orange/20 transition-colors"></div>
                    <p class="text-[9px] uppercase tracking-[0.2em] font-black text-brand-orange">Account Status</p>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-black">Plus Member</p>
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    </div>
                </div>

                <div class="flex items-center gap-4 px-2 py-4 border-t border-white/5">
                    <div class="w-10 h-10 rounded-full bg-brand-orange flex items-center justify-center font-black text-white italic ring-4 ring-brand-orange/10">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-xs font-black truncate">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p class="text-[9px] text-zinc-600 uppercase font-black tracking-widest truncate">Member ID #{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" @click.prevent="$root.submit();" class="text-zinc-600 hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col h-screen overflow-y-auto relative bg-brand-cream/30">
            {{-- Top Navbar Mobile --}}
            <header class="lg:hidden flex items-center justify-between p-6 bg-white border-b border-brand-peach/50 sticky top-0 z-30">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-brand-orange flex items-center justify-center">
                        <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-5 w-auto brightness-0 invert" alt="Logo">
                    </div>
                    <span class="text-lg font-black tracking-tighter">Furniqo</span>
                </div>
                <button class="p-2 rounded-xl bg-brand-cream border border-brand-peach text-brand-dark">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
            </header>

            {{-- Top Action Bar Desktop --}}
            <div class="hidden lg:flex items-center justify-between px-10 py-8 sticky top-0 z-20 bg-brand-cream/80 backdrop-blur-md">
                <div class="flex items-center gap-4">
                    <div class="h-8 w-1 bg-brand-orange rounded-full"></div>
                    <div>
                        <h2 class="text-2xl font-black text-brand-dark tracking-tighter">@yield('dashboard_title', 'Overview')</h2>
                        <nav class="flex text-[10px] font-black uppercase tracking-widest text-zinc-400">
                            <span>Member Portal</span>
                            <span class="mx-2">/</span>
                            <span class="text-brand-orange">@yield('dashboard_title', 'Dashboard')</span>
                        </nav>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing') }}" class="flex items-center gap-3 px-6 py-3 bg-white border border-brand-peach shadow-sm rounded-2xl hover:bg-brand-dark hover:text-white hover:border-brand-dark transition-all group group duration-500">
                        <svg class="w-4 h-4 text-brand-orange group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Back to Store</span>
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
