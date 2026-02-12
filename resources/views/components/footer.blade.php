{{-- Footer --}}
<footer class="bg-brand-dark font-satoshi overflow-hidden relative">
    {{-- Decorative --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-brand-orange/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>

    {{-- Large Brand Wordmark --}}
    <div class="border-b border-white/10">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <h2 class="text-5xl sm:text-7xl lg:text-8xl font-black text-white/5 tracking-tighter leading-none select-none text-center">
                JumpStart
            </h2>
            <p class="text-center text-white/40 text-sm mt-4">
                JumpStart — redefining modern living through design.
            </p>
        </div>
    </div>

    {{-- Footer Content --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 sm:gap-12">
            {{-- Brand --}}
            <div class="space-y-4">
                <a href="{{ route('landing') }}" class="flex items-center space-x-2.5">
                    <img src="{{ asset('assets/icons/Jumpstart.png') }}" class="h-8 w-8 brightness-0 invert" alt="Logo" />
                    <span class="font-bold text-lg text-white tracking-tight">JumpStart</span>
                </a>
                <p class="text-sm text-white/50 leading-relaxed max-w-xs">
                    Crafting premium furniture experiences with a commitment to quality and minimalist elegance.
                </p>

                {{-- Social Icons --}}
                <div class="flex items-center gap-3 pt-2">
                    @php
                        $socials = [
                            ['icon' => 'M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z', 'label' => 'Twitter'],
                            ['icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z', 'label' => 'Instagram'],
                            ['icon' => 'M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z', 'label' => 'Pinterest'],
                        ];
                    @endphp

                    @foreach ($socials as $social)
                        <a href="#" aria-label="{{ $social['label'] }}"
                           class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-orange hover:shadow-lg hover:shadow-brand-orange/20 transition-all duration-300 group">
                            <svg class="w-4 h-4 text-white/60 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $social['icon'] }}"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Discover --}}
            <div>
                <h4 class="text-sm font-semibold mb-6 uppercase tracking-wider text-white">Products</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('landing') }}" class="text-white/50 hover:text-brand-orange transition-colors">Collection</a></li>
                    <li><a href="{{ route('landing') }}" class="text-white/50 hover:text-brand-orange transition-colors">Best Sellers</a></li>
                    <li><a href="{{ route('landing') }}" class="text-white/50 hover:text-brand-orange transition-colors">New Arrivals</a></li>
                    <li><a href="{{ route('landing') }}" class="text-white/50 hover:text-brand-orange transition-colors">Sale</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="text-sm font-semibold mb-6 uppercase tracking-wider text-white">Company</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('about') }}" class="text-white/50 hover:text-brand-orange transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/50 hover:text-brand-orange transition-colors">Contact</a></li>
                    <li><a href="{{ route('blog') }}" class="text-white/50 hover:text-brand-orange transition-colors">Blog</a></li>
                    <li><a href="{{ route('landing') }}" class="text-white/50 hover:text-brand-orange transition-colors">Gallery</a></li>
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="text-sm font-semibold mb-6 uppercase tracking-wider text-white">Support</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('term') }}" class="text-white/50 hover:text-brand-orange transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('term') }}" class="text-white/50 hover:text-brand-orange transition-colors">Terms & Conditions</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/50 hover:text-brand-orange transition-colors">Help Center</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/50 hover:text-brand-orange transition-colors">FAQ</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-white/40">
                    © {{ date('Y') }} JumpStart Furniture. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('term') }}" class="text-xs text-white/40 hover:text-brand-orange transition-colors">Privacy</a>
                    <a href="{{ route('term') }}" class="text-xs text-white/40 hover:text-brand-orange transition-colors">Terms</a>
                </div>
            </div>
        </div>
    </div>
</footer>