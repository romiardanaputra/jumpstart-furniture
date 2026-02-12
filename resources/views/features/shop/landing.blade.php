@section('title_web_page', 'Home — JumpStart Furniture')

<div class="space-y-0 font-satoshi">
    {{-- ===== HERO SECTION ===== --}}
    <section class="relative bg-brand-dark overflow-hidden">
        {{-- Decorative elements --}}
        <div class="absolute top-1/2 right-0 w-96 h-96 bg-brand-orange/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-brand-peach/5 rounded-full blur-2xl"></div>

        <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center min-h-[500px] sm:min-h-[600px] lg:min-h-[680px] py-12 lg:py-0">

                {{-- Left: Text Content --}}
                <div class="space-y-6 sm:space-y-8 relative z-10">
                    {{-- Brand wordmark --}}
                    <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black text-white/10 leading-none tracking-tighter select-none absolute -top-4 sm:-top-8 -left-2">
                        JumpStart
                    </h1>

                    <div class="relative pt-12 sm:pt-16">
                        <p class="text-sm font-semibold uppercase tracking-widest text-brand-orange mb-4">Premium Furniture Collection</p>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                            Experience the art of simplicity — furniture built for
                            <span class="text-brand-orange">modern homes.</span>
                        </h2>
                    </div>

                    <p class="text-white/60 text-base sm:text-lg leading-relaxed max-w-lg">
                        Discover handcrafted pieces that blend natural beauty with contemporary design,
                        making every room a masterpiece.
                    </p>

                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('landing') }}"
                           class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-orange text-white rounded-full font-semibold text-sm
                                  transition-all duration-300 hover:bg-brand-orange/90 hover:shadow-lg hover:shadow-brand-orange/25 hover:-translate-y-0.5 group">
                            Explore All
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 px-6 py-3.5 border border-white/20 text-white rounded-full font-medium text-sm
                                  transition-all duration-300 hover:bg-white/10 hover:-translate-y-0.5">
                            Our Story
                        </a>
                    </div>

                    {{-- Stats row --}}
                    <div class="flex flex-wrap items-center gap-8 sm:gap-12 pt-4 sm:pt-8 border-t border-white/10">
                        @php
                            $heroStats = [
                                ['num' => '10+', 'label' => 'Years of Journey'],
                                ['num' => '12K+', 'label' => 'Loyal Customers'],
                                ['num' => '200+', 'label' => 'Collection Series'],
                            ];
                        @endphp
                        @foreach ($heroStats as $stat)
                            <div>
                                <span class="text-2xl sm:text-3xl font-bold text-white">{{ $stat['num'] }}</span>
                                <p class="text-xs text-white/50 mt-0.5">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Hero Image --}}
                <div class="relative hidden lg:block">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('assets/landing-banner.jpeg') }}"
                             class="w-full h-[580px] object-cover"
                             alt="Premium furniture showroom">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/40 via-transparent to-transparent"></div>
                    </div>

                    {{-- Floating product card --}}
                    <div class="absolute bottom-8 left-8 bg-white/95 backdrop-blur-sm rounded-2xl px-5 py-4 shadow-xl flex items-center gap-4 max-w-[220px]">
                        <div>
                            <p class="text-xs text-muted-foreground">Modern Chair</p>
                            <p class="text-lg font-bold text-brand-dark">$99</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-brand-dark flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Floating secondary image --}}
                    <div class="absolute -top-4 -right-4 w-32 h-32 rounded-2xl overflow-hidden shadow-lg border-4 border-brand-dark">
                        <img src="{{ asset('assets/landing-banner-2.png') }}" class="w-full h-full object-cover" alt="Furniture detail">
                    </div>

                    {{-- Orange accent dot --}}
                    <div class="absolute top-1/2 -left-6 w-12 h-12 rounded-full bg-brand-orange shadow-lg shadow-brand-orange/30"></div>
                </div>

                {{-- Mobile hero image --}}
                <div class="relative lg:hidden">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ asset('assets/landing-banner.jpeg') }}"
                             class="w-full h-[300px] sm:h-[400px] object-cover"
                             alt="Premium furniture showroom">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/40 via-transparent to-transparent rounded-2xl"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom wave --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 60L1440 60L1440 30C1440 30 1200 0 720 0C240 0 0 30 0 30L0 60Z" fill="hsl(33, 90%, 95%)"/>
            </svg>
        </div>
    </section>

    {{-- ===== PROMO CARDS SECTION ===== --}}
    <section class="bg-brand-cream py-16 sm:py-24">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                @php
                    $promos = [
                        [
                            'image' => 'op-product-image.png',
                            'discount' => 'up to 30% off',
                            'title' => 'Treakwood Ratan Armchair',
                            'cta' => 'Shop Now'
                        ],
                        [
                            'image' => 'op-product-image-2.png',
                            'discount' => 'up to 20% off',
                            'title' => 'Table with Hutch Cabinet',
                            'cta' => 'Discover'
                        ]
                    ];
                @endphp

                @foreach ($promos as $promo)
                    <div class="relative group h-[300px] sm:h-[380px] overflow-hidden rounded-3xl cursor-pointer shadow-lg hover:shadow-xl transition-all duration-500">
                        <div style="background-image: url('{{ asset('assets/' . $promo['image']) }}');"
                             class="absolute inset-0 bg-center bg-no-repeat bg-cover transition-transform duration-700 group-hover:scale-110"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/60 via-brand-dark/10 to-transparent"></div>

                        {{-- Content --}}
                        <div class="absolute inset-x-6 sm:inset-x-8 bottom-6 sm:bottom-8 space-y-3">
                            <span class="inline-block px-3 py-1 bg-brand-orange text-white text-xs font-bold uppercase tracking-wider rounded-full">
                                {{ $promo['discount'] }}
                            </span>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white leading-tight">{{ $promo['title'] }}</h3>
                            <div class="flex items-center gap-2 text-white/80 text-sm font-medium group-hover:text-brand-orange transition-colors">
                                {{ $promo['cta'] }}
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Orange corner accent --}}
                        <div class="absolute top-4 right-4 w-10 h-10 rounded-full bg-brand-orange/80 flex items-center justify-center opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== BEST SELLING PRODUCTS ===== --}}
    <x-best-product />

    {{-- ===== ABOUT SECTION ===== --}}
    <x-about />

    {{-- ===== PARALLAX BANNER SECTION ===== --}}
    <section class="relative h-[400px] sm:h-[550px] lg:h-[600px] w-full overflow-hidden">
        <div style="background-image: url('{{ asset('assets/parallax-img.png') }}');"
             class="absolute inset-0 bg-center bg-no-repeat bg-cover bg-fixed">
        </div>
        {{-- Dark green gradient overlay --}}
        <div class="absolute inset-0" style="background: linear-gradient(135deg, hsla(160, 30%, 15%, 0.8), hsla(160, 30%, 15%, 0.6))"></div>

        <div class="relative h-full flex items-center">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-2xl space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="h-[2px] w-8 bg-brand-orange"></div>
                        <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Exclusive Collection</span>
                    </div>

                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        Empty Living Room <br class="hidden sm:block">
                        <span class="text-brand-orange">&</span> Blue Sofa
                    </h2>

                    <p class="text-white/60 text-base sm:text-lg leading-relaxed max-w-lg">
                        Transform your living space with our exclusive collection of premium sofas and contemporary furniture.
                    </p>

                    <a href="{{ route('landing') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-orange text-white rounded-full font-semibold text-sm
                              transition-all duration-300 hover:bg-brand-orange/90 hover:shadow-lg hover:shadow-brand-orange/25 hover:-translate-y-0.5 group">
                        Shop Now
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FEATURED COLLECTION ===== --}}
    <x-featured-collection />

    {{-- ===== BLOG ===== --}}
    <section class="bg-brand-cream">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-blog />
        </div>
    </section>

    {{-- ===== NEWSLETTER CTA ===== --}}
    <section class="bg-white py-16 sm:py-20">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-dark rounded-[2rem] p-10 sm:p-16 relative overflow-hidden">
                {{-- Decorative --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-orange/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="text-center lg:text-left">
                        <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">Subscribe to Our Newsletter</h3>
                        <p class="text-white/60 text-sm sm:text-base">Get the latest collections, deals and design inspiration delivered to your inbox.</p>
                    </div>
                    <div class="flex w-full max-w-md">
                        <input type="email" placeholder="Enter email address"
                               class="flex-1 px-5 py-3.5 rounded-l-full bg-white/10 border border-white/20 text-white placeholder:text-white/40 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-colors">
                        <button class="px-6 py-3.5 bg-brand-orange text-white rounded-r-full font-semibold text-sm hover:bg-brand-orange/90 transition-colors whitespace-nowrap flex items-center gap-2">
                            Send
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
