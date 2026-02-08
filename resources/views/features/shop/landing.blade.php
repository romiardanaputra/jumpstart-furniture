@section('title_web_page', 'Home')

<div class="space-y-0">
    {{-- Hero Carousel Section --}}
    <section class="relative overflow-hidden">
        <div id="hero-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel items -->
            <div class="relative h-[450px] sm:h-[600px] lg:h-[800px] overflow-hidden">
                @php
                    $slides = [
                        [
                            'image' => 'landing-banner.jpeg',
                            'discount' => 'up to 30% discount',
                            'title' => 'Interior Minimal Room Style',
                            'align' => 'lg:justify-end'
                        ],
                        [
                            'image' => 'landing-banner-2.png',
                            'discount' => 'up to 40% discount',
                            'title' => 'Living Room Loft In Industrial',
                            'align' => 'lg:justify-start'
                        ],
                        [
                            'image' => 'parallax01.jpeg',
                            'discount' => 'exclusive collection',
                            'title' => 'Modern Luxury Furniture Sets',
                            'align' => 'lg:justify-center'
                        ]
                    ];
                @endphp

                @foreach ($slides as $slide)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('assets/' . $slide['image']) }}" class="absolute block w-full h-full object-cover" alt="Banner slide">
                        <div class="absolute inset-0 bg-black/10"></div>
                        <div class="relative h-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center {{ $slide['align'] }}">
                            <div class="max-w-xl w-full text-center lg:text-left space-y-4 sm:space-y-6 p-6 sm:p-10 rounded-2xl sm:rounded-3xl backdrop-blur-md bg-white/20 border border-white/30 shadow-2xl transition-all">
                                <p class="text-xs sm:text-sm font-bold uppercase tracking-widest text-[#F4841A]">{{ $slide['discount'] }}</p>
                                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-foreground leading-tight tracking-tight">
                                    {{ $slide['title'] }}
                                </h1>
                                <div class="pt-2 sm:pt-4">
                                    <a href="{{ route('landing') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 text-xs sm:text-sm font-bold uppercase tracking-widest text-white bg-[#F4841A] hover:bg-gray-900 rounded-full transition-all hover:scale-105 shadow-xl">
                                        Shop Now
                                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Slider indicators -->
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-10 left-1/2">
                @foreach ($slides as $index => $slide)
                    <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-colors" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                @endforeach
            </div>

            <!-- Slider controls -->
            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 sm:px-6 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 group-hover:bg-white/40 group-focus:ring-4 group-focus:ring-white/50 transition-all">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            </button>
            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 sm:px-6 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 group-hover:bg-white/40 group-focus:ring-4 group-focus:ring-white/50 transition-all">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </button>
        </div>
    </section>

        {{-- end carousel section --}}

        {{-- image product op (Promo Section) --}}
        <section class="py-16 sm:py-24 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                @php
                    $promos = [
                        [
                            'image' => 'op-product-image.png',
                            'discount' => 'up to 30% off',
                            'title' => 'Treakwood Ratan Archnair'
                        ],
                        [
                            'image' => 'op-product-image-2.png',
                            'discount' => 'up to 20% off',
                            'title' => 'Table with Hunch Cabinet'
                        ]
                    ];
                @endphp

                @foreach ($promos as $promo)
                    <div class="relative group h-[300px] sm:h-[400px] overflow-hidden rounded-2xl cursor-pointer shadow-lg">
                        <div style="background-image: url('{{ asset('assets/' . $promo['image']) }}');" class="absolute inset-0 bg-center bg-no-repeat bg-cover transition-transform duration-700 group-hover:scale-110"></div>
                        <div class="absolute inset-0 bg-black/10 transition-colors group-hover:bg-black/20"></div>
                        <div class="absolute inset-x-6 sm:inset-x-8 bottom-6 sm:bottom-8 lg:top-12 lg:bottom-auto">
                            <div class="max-w-[240px] sm:max-w-[280px] space-y-1 sm:space-y-2 p-4 sm:p-6 rounded-2xl backdrop-blur-md bg-white/30 border border-white/20 shadow-sm">
                                <p class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-[#F4841A]">{{ $promo['discount'] }}</p>
                                <h3 class="text-xl sm:text-3xl font-bold text-foreground leading-tight">{{ $promo['title'] }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        {{-- end image product --}}


        {{-- Best selling product --}}
        <x-best-product />
        {{--end best product --}}

        {{-- about section --}}
        <x-about />
        {{-- end about section --}}

        {{-- Parallax Banner Section --}}
        <section class="relative h-[400px] sm:h-[600px] lg:h-[700px] w-full overflow-hidden">
            <div style="background-image: url('{{ asset('assets/parallax-img.png') }}');" class="absolute inset-0 bg-center bg-no-repeat bg-cover bg-fixed flex items-center">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl text-center lg:text-left space-y-4 sm:space-y-6">
                        <p class="text-xs sm:text-sm font-bold uppercase tracking-widest text-[#F4841A]">up to 30% discount</p>
                        <h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                            Empty Living Room & Blue Sofa
                        </h2>
                        <div class="pt-2 sm:pt-4">
                            <a href="{{ route('landing') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 text-xs sm:text-sm font-bold uppercase tracking-widest text-white bg-[#F4841A] hover:bg-white hover:text-gray-900 rounded-full transition-all hover:scale-105 shadow-xl group">
                                Shop Now
                                <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- end parralax banner --}}

        {{-- featured collection start --}}
        <x-featured-collection />
        {{-- featured collection end --}}

        {{-- blog --}}
        <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-blog />
        </section>
        {{-- end blog --}}
    </div>
</div>

