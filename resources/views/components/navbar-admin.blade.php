<nav class="sticky top-0 z-40 w-full border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="mx-auto flex h-16 max-w-screen-2xl items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-4 sm:gap-6">
            <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto" alt="Jumpstart-logo" />
                <span class="inline-block font-bold sm:text-lg">JumpStart Admin</span>
            </a>
            
            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">Home</a>
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">Support</a>
                <a href="{{ route('blog') }}" class="{{ Request::is('blog') ? 'text-foreground' : 'text-muted-foreground' }} transition-colors hover:text-foreground">News</a>
            </nav>
        </div>

        <div class="flex items-center gap-4">
            {{-- User Menu --}}
            <div class="ml-3 relative">
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
                                Admin: {{ Auth::user()->first_name }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-muted-foreground">{{ __('Administration') }}</div>
                        <x-jet-dropdown-link href="{{ route('manage-user') }}">{{ __('Manage User') }}</x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('manage-blog') }}">{{ __('Manage Blog') }}</x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('manage-product') }}">{{ __('Manage Product') }}</x-jet-dropdown-link>
                        
                        <div class="border-t border-border"></div>
                        <div class="block px-4 py-2 text-xs text-muted-foreground">{{ __('Account') }}</div>
                        <x-jet-dropdown-link href="{{ route('profile.show') }}">{{ __('Profile') }}</x-jet-dropdown-link>
                        
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
                data-drawer-target="drawer-admin" data-drawer-show="drawer-admin" aria-controls="drawer-admin">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Sidebar Drawer --}}
<div id="drawer-admin" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-background w-64 border-r border-border" tabindex="-1" aria-labelledby="drawer-admin-label">
    <h5 id="drawer-admin-label" class="text-base font-semibold text-muted-foreground uppercase tracking-wider mb-6">Admin Panel</h5>
    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Home</span>
        </a>
        <a href="{{ route('manage-user') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Manage User</span>
        </a>
        <a href="{{ route('manage-blog') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Manage Blog</span>
        </a>
        <a href="{{ route('manage-product') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
            <span class="ml-3 font-medium">Manage Product</span>
        </a>
        <div class="pt-4 border-t border-border">
            <a href="{{ route('profile.show') }}" class="flex items-center p-2 text-foreground rounded-lg hover:bg-accent group transition-colors">
                <span class="ml-3 font-medium">Profile</span>
            </a>
        </div>
    </nav>
</div>
