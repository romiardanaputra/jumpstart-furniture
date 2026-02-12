
<nav class="sticky top-0 z-40 w-full bg-brand-cream/95 backdrop-blur-md supports-[backdrop-filter]:bg-brand-cream/80 font-satoshi transition-all duration-300"
     x-data="{ scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'shadow-lg shadow-brand-dark/5 border-b border-brand-peach' : 'border-b border-transparent'">

    <div class="mx-auto flex h-16 sm:h-18 max-w-screen-xl items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Left: Logo + Nav Links --}}
        <div class="flex items-center gap-6 sm:gap-8">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2.5 group">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto transition-transform group-hover:scale-105" alt="Jumpstart-logo" />
                <span class="inline-block font-bold text-lg text-brand-dark tracking-tight">JumpStart</span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                @php
                    $navLinks = [
                        ['route' => 'landing', 'label' => 'Home', 'match' => '/'],
                        ['route' => 'about', 'label' => 'About', 'match' => 'about'],
                        ['route' => 'contact', 'label' => 'Contact', 'match' => 'contact'],
                        ['route' => 'blog', 'label' => 'News', 'match' => 'blog'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="relative px-4 py-2 rounded-full text-sm font-medium transition-all duration-300
                              {{ Request::is($link['match']) 
                                  ? 'bg-brand-orange text-white shadow-md shadow-brand-orange/20' 
                                  : 'text-brand-dark/70 hover:text-brand-dark hover:bg-brand-peach/50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Right: Social proof + Auth --}}
        <div class="flex items-center gap-3 sm:gap-4">
            {{-- Social proof badge --}}
            <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/80 border border-brand-peach shadow-sm">
                <div class="flex -space-x-1.5">
                    <div class="w-6 h-6 rounded-full bg-brand-orange flex items-center justify-center ring-2 ring-white">
                        <span class="text-white text-[10px] font-bold">J</span>
                    </div>
                    <div class="w-6 h-6 rounded-full bg-brand-dark flex items-center justify-center ring-2 ring-white">
                        <span class="text-white text-[10px] font-bold">S</span>
                    </div>
                    <div class="w-6 h-6 rounded-full bg-brand-peach flex items-center justify-center ring-2 ring-white">
                        <span class="text-brand-dark text-[10px] font-bold">F</span>
                    </div>
                </div>
                <span class="text-xs font-semibold text-brand-dark whitespace-nowrap">10K+ Customers</span>
            </div>

            <a href="{{ route('login') }}" class="hidden sm:block">
                <button type="button" class="px-4 py-2 text-sm font-medium text-brand-dark/70 hover:text-brand-dark transition-colors rounded-full hover:bg-brand-peach/40">
                    Sign In
                </button>
            </a>
            <a href="{{ route('register') }}">
                <button type="button" class="px-5 py-2.5 text-sm font-semibold text-white bg-brand-orange rounded-full shadow-md shadow-brand-orange/20 hover:bg-brand-orange/90 hover:shadow-lg hover:shadow-brand-orange/30 hover:-translate-y-0.5 transition-all duration-300">
                    Join With Us
                </button>
            </a>

            {{-- Mobile Menu Trigger --}}
            <button class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl text-brand-dark hover:bg-brand-peach/50 transition-colors"
                data-drawer-target="drawer-navigation-guest" data-drawer-show="drawer-navigation-guest" aria-controls="drawer-navigation-guest">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Sidebar Drawer --}}
<div id="drawer-navigation-guest" class="fixed top-0 left-0 z-50 h-screen p-6 overflow-y-auto transition-transform -translate-x-full bg-brand-cream w-72 shadow-2xl" tabindex="-1" aria-labelledby="drawer-guest-label">
    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('landing') }}" class="flex items-center space-x-2">
            <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-7 w-auto" alt="Jumpstart-logo" />
            <span class="font-bold text-lg text-brand-dark">JumpStart</span>
        </a>
        <button type="button" data-drawer-hide="drawer-navigation-guest" class="w-8 h-8 rounded-lg bg-brand-peach/50 flex items-center justify-center hover:bg-brand-peach transition-colors">
            <svg class="w-4 h-4 text-brand-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="space-y-1">
        @foreach ($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200
                      {{ Request::is($link['match']) 
                          ? 'bg-brand-orange text-white shadow-sm' 
                          : 'text-brand-dark/70 hover:bg-brand-peach/50 hover:text-brand-dark' }}">
                {{ $link['label'] }}
            </a>
        @endforeach

        <div class="pt-6 mt-6 border-t border-brand-peach">
            <a href="{{ route('login') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium text-brand-dark/70 hover:bg-brand-peach/50 hover:text-brand-dark transition-all">
                Sign In
            </a>
            <a href="{{ route('register') }}" class="mt-2 flex items-center justify-center px-4 py-3 rounded-xl text-sm font-semibold text-white bg-brand-orange shadow-sm hover:bg-brand-orange/90 transition-all">
                Join With Us
            </a>
        </div>
    </nav>
</div>
