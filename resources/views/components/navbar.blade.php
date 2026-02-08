
<nav class="sticky top-0 z-40 w-full border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-4 sm:gap-6">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto" alt="Jumpstart-logo" />
                <span class="inline-block font-bold sm:text-lg">JumpStart</span>
            </a>
            
            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('landing') }}" class="{{ Request::is('/') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">Home</a>
                <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">About</a>
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">Contact</a>
                <a href="{{ route('blog') }}" class="{{ Request::is('blog') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">News</a>
            </nav>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('login') }}" class="hidden sm:block">
                <x-ui.button variant="ghost" size="sm">Sign In</x-ui.button>
            </a>
            <a href="{{ route('register') }}">
                <x-ui.button size="sm">Join With Us</x-ui.button>
            </a>

            {{-- Mobile Menu Trigger --}}
            <button class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                data-drawer-target="drawer-navigation-guest" data-drawer-show="drawer-navigation-guest" aria-controls="drawer-navigation-guest">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Sidebar Drawer --}}
<div id="drawer-navigation-guest" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-background w-64 border-r border-border" tabindex="-1" aria-labelledby="drawer-guest-label">
    <h5 id="drawer-guest-label" class="text-base font-semibold text-muted-foreground uppercase tracking-wider mb-6">Menu</h5>
    <nav class="space-y-2">
        <a href="{{ route('landing') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Home</span>
        </a>
        <a href="{{ route('about') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">About Us</span>
        </a>
        <a href="{{ route('contact') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Contact Us</span>
        </a>
        <a href="{{ route('blog') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">News</span>
        </a>
        <div class="pt-4 border-t border-border">
            <a href="{{ route('login') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
                <span class="ml-3 font-medium">Sign In</span>
            </a>
        </div>
    </nav>
</div>
