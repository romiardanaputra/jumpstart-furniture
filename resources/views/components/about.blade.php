{{-- About Us Section — Homepage --}}
<section class="bg-brand-cream py-20 sm:py-28 font-satoshi overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Left: Image Gallery --}}
            <div class="relative">
                {{-- Main Image --}}
                <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl">
                    <img class="w-full h-[420px] sm:h-[500px] object-cover"
                         src="{{ asset('assets/about.png') }}"
                         alt="Premium furniture showroom interior">
                    {{-- Overlay gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                </div>

                {{-- Floating secondary image --}}
                <div class="absolute -bottom-6 -right-4 sm:-bottom-8 sm:-right-8 z-20 w-40 h-40 sm:w-52 sm:h-52 rounded-2xl overflow-hidden shadow-xl border-4 border-brand-cream">
                    <img class="w-full h-full object-cover"
                         src="{{ asset('assets/landing-banner-2.png') }}"
                         alt="Curated furniture detail">
                </div>

                {{-- Client Review floating badge --}}
                <div class="absolute bottom-4 left-4 sm:bottom-6 sm:left-6 z-30 bg-white/95 backdrop-blur-sm rounded-2xl px-4 py-3 shadow-lg flex items-center gap-3">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-brand-orange flex items-center justify-center text-white text-xs font-bold">J</div>
                        <div class="w-8 h-8 rounded-full bg-brand-dark flex items-center justify-center text-white text-xs font-bold">S</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-1">
                            <span class="text-brand-orange font-bold text-sm">5.0</span>
                            <svg class="w-3.5 h-3.5 text-brand-orange" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-xs text-muted-foreground">Clients Review</p>
                    </div>
                </div>

                {{-- Decorative orange dot --}}
                <div class="absolute -top-4 -left-4 w-16 h-16 rounded-full bg-brand-orange/20 blur-xl"></div>
                <div class="absolute top-1/3 -right-6 w-8 h-8 rounded-full bg-brand-orange"></div>
            </div>

            {{-- Right: Content --}}
            <div class="space-y-8">
                {{-- Subtitle --}}
                <div class="flex items-center gap-3">
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                    <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">About Us</span>
                </div>

                {{-- Headline --}}
                <h2 class="text-3xl sm:text-4xl lg:text-[2.75rem] font-bold text-foreground leading-tight">
                    At Jumpstart, we craft <span class="text-brand-orange">timeless furniture</span> that blends natural materials with modern design
                </h2>

                {{-- Description --}}
                <p class="text-muted-foreground leading-relaxed text-base sm:text-lg">
                    We believe every piece of furniture tells a story. From carefully sourced hardwoods to
                    precision-crafted joints — bringing <strong class="text-foreground">beauty and comfort</strong> into your home,
                    one piece at a time.
                </p>

                {{-- CTA Button --}}
                <a href="{{ route('about') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-orange text-white rounded-full font-semibold text-sm
                          transition-all duration-300 hover:bg-brand-orange/90 hover:shadow-lg hover:shadow-brand-orange/25 hover:-translate-y-0.5 group">
                    More About Us
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Bottom Stats Bar --}}
        <div class="mt-20 sm:mt-28 grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8">
            @php
                $stats = [
                    ['number' => '10+', 'label' => 'Years of Journey'],
                    ['number' => '12K+', 'label' => 'Loyal Customers'],
                    ['number' => '200+', 'label' => 'Collection Series'],
                    ['number' => '50+', 'label' => 'Design Awards'],
                ];
            @endphp

            @foreach ($stats as $index => $stat)
                <div class="text-center sm:text-left group">
                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-2 sm:gap-4">
                        <span class="text-3xl sm:text-4xl font-bold text-brand-dark font-satoshi tracking-tight group-hover:text-brand-orange transition-colors duration-300">
                            {{ $stat['number'] }}
                        </span>
                        @if (!$loop->last)
                            <div class="hidden sm:block h-10 w-px bg-border"></div>
                        @endif
                    </div>
                    <p class="text-sm text-muted-foreground mt-2 font-medium">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
