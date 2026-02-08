<nav class="sticky top-0 z-40 w-full border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-4 sm:gap-6">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto" alt="Jumpstart-logo" />
                <span class="inline-block font-bold sm:text-lg">JumpStart</span>
            </a>
            
            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">Home</a>
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">Contact</a>
                <a href="{{ route('blog') }}" class="{{ Request::is('blog') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">News</a>
            </nav>
        </div>

        <div class="flex items-center gap-2">
            {{-- Cart Icon --}}
            <button 
                data-drawer-target="drawer-right-example" 
                data-drawer-show="drawer-right-example" 
                data-drawer-placement="right" 
                aria-controls="drawer-right-example"
                class="inline-flex h-10 w-10 items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </button>

            {{-- User Menu --}}
            <div class="ml-2 relative" x-data="{ open: false }">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex items-center text-sm transition focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 rounded-full">
                                <img class="h-8 w-8 rounded-full object-cover border border-border" 
                                     src="{{ Auth::user()->profile_photo_url }}" 
                                     alt="{{ Auth::user()->first_name }}" />
                            </button>
                        @else
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-border text-sm leading-4 font-medium rounded-md text-muted-foreground bg-background hover:text-foreground hover:bg-accent transition ease-in-out duration-150">
                                {{ Auth::user()->first_name }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-muted-foreground">{{ __('Manage Account') }}</div>
                        <x-jet-dropdown-link href="{{ route('profile.show') }}">{{ __('Profile') }}</x-jet-dropdown-link>
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</x-jet-dropdown-link>
                        @endif
                        <div class="border-t border-border"></div>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            {{-- Mobile Menu Trigger --}}
            <button class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Sidebar Drawer --}}
<div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-background w-64 border-r border-border" tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-muted-foreground uppercase tracking-wider mb-6">Menu</h5>
    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Home</span>
        </a>
        <a href="{{ route('contact') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Contact Us</span>
        </a>
        <a href="{{ route('blog') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">News</span>
        </a>
    </nav>
</div>

{{-- Shopping Cart Drawer (Preserving functionality with new styling) --}}
<div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-background w-full sm:w-96 border-l border-border" tabindex="-1" aria-labelledby="drawer-right-label">
    <h5 id="drawer-right-label" class="inline-flex items-center mb-6 text-base font-semibold text-foreground">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
        Your Shopping Cart
    </h5>
    <button type="button" data-drawer-dismiss="drawer-right-example" aria-controls="drawer-right-example" class="text-muted-foreground bg-transparent hover:bg-accent rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close cart</span>
    </button>
    
    <div class="space-y-4">
        @forelse($items as $item)
            <div class="flex items-center gap-4 border-b border-border pb-4">
                <img src="{{ asset('assets/watch.png') }}" alt="item" class="h-16 w-16 rounded-md object-cover border border-border">
                <div class="flex-1">
                    <p class="text-sm font-medium">Luxury Watch From Gucci</p>
                    <p class="text-xs text-muted-foreground">1 x $340.20</p>
                </div>
                <button class="text-muted-foreground hover:text-destructive transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </div>
        @empty
            <div class="py-12 text-center text-muted-foreground">Your cart is empty</div>
        @endforelse
    </div>

    <div class="absolute bottom-4 left-4 right-4 space-y-2">
        <a href="{{ route('shopping-cart') }}" class="block">
            <x-ui.button variant="outline" class="w-full">View Cart</x-ui.button>
        </a>
        <a href="{{ route('info-status') }}" class="block">
            <x-ui.button class="w-full">Check Out</x-ui.button>
        </a>
    </div>
</div>