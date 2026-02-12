@section('title_web_page','About Us — JumpStart Furniture')

<div class="font-satoshi">

    {{-- Hero Banner --}}
    <section class="relative bg-brand-dark overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-brand-orange rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-peach rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>

        <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:py-40">
            <div class="max-w-3xl">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
                    <a href="{{ route('landing') }}" class="hover:text-brand-orange transition-colors">Home</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-brand-orange">About Us</span>
                </nav>

                <div class="flex items-center gap-3 mb-6">
                    <div class="h-[2px] w-10 bg-brand-orange"></div>
                    <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Our Story</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Crafting Furniture <br>
                    <span class="text-brand-orange">That Inspires</span> Living
                </h1>

                <p class="text-lg sm:text-xl text-white/70 leading-relaxed max-w-2xl">
                    We're on a mission to transform spaces through thoughtfully designed furniture that
                    combines sustainability, comfort, and timeless aesthetics.
                </p>
            </div>
        </div>

        {{-- Bottom wave --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 60L1440 60L1440 30C1440 30 1200 0 720 0C240 0 0 30 0 30L0 60Z" fill="hsl(33, 90%, 95%)"/>
            </svg>
        </div>
    </section>

    {{-- Our Story Section --}}
    <section class="bg-brand-cream py-20 sm:py-28">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">
                {{-- Left: Content --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="h-[2px] w-8 bg-brand-orange"></div>
                        <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Who We Are</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-bold text-foreground leading-tight">
                        A Passion for <span class="text-brand-orange">Timeless Design</span>
                    </h2>

                    <p class="text-muted-foreground leading-relaxed text-base sm:text-lg">
                        Founded with a vision to redefine modern living, <strong class="text-foreground">JumpStart Furniture</strong>
                        has been at the forefront of furniture innovation for over a decade. We believe that great furniture
                        does more than fill a room — it shapes how you live, work, and connect.
                    </p>

                    <p class="text-muted-foreground leading-relaxed text-base sm:text-lg">
                        Every piece in our collection starts with a sketch, passes through the hands of master craftsmen,
                        and arrives at your doorstep ready to become part of your story. We use sustainably sourced
                        hardwoods, premium upholstery fabrics, and time-honored joinery techniques that ensure each
                        creation lasts for generations.
                    </p>

                    <div class="flex flex-wrap gap-4 pt-4">
                        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm">
                            <div class="w-2 h-2 rounded-full bg-brand-orange"></div>
                            <span class="text-sm font-medium text-foreground">Sustainable Materials</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm">
                            <div class="w-2 h-2 rounded-full bg-brand-orange"></div>
                            <span class="text-sm font-medium text-foreground">Handcrafted Quality</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm">
                            <div class="w-2 h-2 rounded-full bg-brand-orange"></div>
                            <span class="text-sm font-medium text-foreground">Modern Design</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Image --}}
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img class="w-full h-[500px] object-cover" src="{{ asset('assets/about.png') }}" alt="JumpStart furniture workshop">
                    </div>
                    {{-- Decorative elements --}}
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 rounded-2xl bg-brand-orange/10 -z-10"></div>
                    <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full bg-brand-peach -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats / Achievements --}}
    <section class="bg-brand-dark py-16 sm:py-20">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 sm:gap-12 text-center">
                @php
                    $stats = [
                        ['number' => '10+', 'label' => 'Years of Journey', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['number' => '12K+', 'label' => 'Happy Customers', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['number' => '200+', 'label' => 'Collections', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                        ['number' => '50+', 'label' => 'Design Awards', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="group">
                        <div class="mx-auto w-14 h-14 rounded-2xl bg-brand-orange/20 flex items-center justify-center mb-4 group-hover:bg-brand-orange/30 transition-colors duration-300">
                            <svg class="w-6 h-6 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="block text-3xl sm:text-4xl font-bold text-white font-satoshi tracking-tight group-hover:text-brand-orange transition-colors duration-300">
                            {{ $stat['number'] }}
                        </span>
                        <p class="text-sm text-white/60 mt-2 font-medium">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose Us / Our Values --}}
    <section class="bg-white py-20 sm:py-28">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                    <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Why Choose Us</span>
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground leading-tight">
                    Built on Values That <span class="text-brand-orange">Matter</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $values = [
                        [
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'title' => 'Premium Quality',
                            'desc' => 'Every piece passes through rigorous quality checks. We use Grade-A hardwoods and premium fabrics that stand the test of time.',
                        ],
                        [
                            'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                            'title' => 'Crafted with Love',
                            'desc' => 'Our artisans pour decades of experience into every joint, curve, and finish — creating furniture that feels personal and alive.',
                        ],
                        [
                            'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'Sustainably Sourced',
                            'desc' => 'We partner with certified forests and eco-conscious suppliers, ensuring our furniture leaves the lightest footprint possible.',
                        ],
                        [
                            'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                            'title' => 'Free Shipping',
                            'desc' => 'Enjoy complimentary worldwide delivery on all orders. We handle logistics so you can focus on designing your dream space.',
                        ],
                        [
                            'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                            'title' => '30-Day Returns',
                            'desc' => 'Not the perfect fit? No worries. Our hassle-free 30-day return policy means you shop with zero risk and total confidence.',
                        ],
                        [
                            'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                            'title' => '24/7 Support',
                            'desc' => 'Our dedicated design consultants are always available to help you choose the right pieces and create your ideal living environment.',
                        ],
                    ];
                @endphp

                @foreach ($values as $index => $value)
                    <div class="group relative p-8 rounded-3xl bg-brand-cream/50 border border-transparent hover:border-brand-orange/20
                                hover:bg-brand-peach/40 transition-all duration-500 hover:shadow-lg hover:shadow-brand-orange/5 hover:-translate-y-1">
                        <div class="w-14 h-14 rounded-2xl bg-brand-orange/10 flex items-center justify-center mb-6
                                    group-hover:bg-brand-orange group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6 text-brand-orange group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $value['icon'] }}"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-foreground mb-3 group-hover:text-brand-dark transition-colors">
                            {{ $value['title'] }}
                        </h3>
                        <p class="text-muted-foreground leading-relaxed text-sm">
                            {{ $value['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Our Team --}}
    <section class="bg-brand-cream py-20 sm:py-28">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                    <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Our Team</span>
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-foreground leading-tight">
                    Meet the <span class="text-brand-orange">Creative Minds</span>
                </h2>
                <p class="text-muted-foreground mt-4 text-base sm:text-lg">
                    A passionate team of designers, craftsmen, and dreamers dedicated to transforming your spaces.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $team = [
                        ['name' => 'Sarah Mitchell', 'role' => 'Founder & CEO', 'initial' => 'SM', 'color' => 'bg-brand-orange'],
                        ['name' => 'David Chen', 'role' => 'Head of Design', 'initial' => 'DC', 'color' => 'bg-brand-dark'],
                        ['name' => 'Amelia Rose', 'role' => 'Lead Craftsman', 'initial' => 'AR', 'color' => 'bg-brand-orange'],
                        ['name' => 'James Walker', 'role' => 'Operations Director', 'initial' => 'JW', 'color' => 'bg-brand-dark'],
                    ];
                @endphp

                @foreach ($team as $member)
                    <div class="group text-center">
                        <div class="relative mx-auto w-40 h-40 sm:w-48 sm:h-48 rounded-3xl overflow-hidden mb-6
                                    shadow-lg group-hover:shadow-xl transition-all duration-500 group-hover:-translate-y-2">
                            {{-- Avatar placeholder with initials --}}
                            <div class="{{ $member['color'] }} w-full h-full flex items-center justify-center">
                                <span class="text-white text-4xl sm:text-5xl font-bold font-satoshi">{{ $member['initial'] }}</span>
                            </div>
                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-brand-orange/0 group-hover:bg-brand-orange/20 transition-all duration-500 flex items-end justify-center pb-4">
                                <div class="flex gap-3 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    <div class="w-8 h-8 rounded-full bg-white/90 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-brand-dark" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-white/90 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-brand-dark" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-foreground">{{ $member['name'] }}</h3>
                        <p class="text-brand-orange font-medium text-sm mt-1">{{ $member['role'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA / Contact Section --}}
    <section class="bg-white py-20 sm:py-28">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-brand-dark rounded-[2rem] overflow-hidden p-10 sm:p-16 lg:p-20">
                {{-- Decorative shapes --}}
                <div class="absolute top-0 right-0 w-72 h-72 bg-brand-orange/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-brand-peach/10 rounded-full blur-2xl translate-y-1/3 -translate-x-1/4"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="h-[2px] w-8 bg-brand-orange"></div>
                            <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Get in Touch</span>
                        </div>

                        <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight mb-4">
                            Ready to Transform <br>
                            <span class="text-brand-orange">Your Space?</span>
                        </h2>

                        <p class="text-white/70 leading-relaxed text-base sm:text-lg mb-8">
                            Whether you're furnishing a new home or refreshing a favourite room, our design consultants
                            are here to help you find the perfect pieces.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-orange text-white rounded-full font-semibold text-sm
                                      transition-all duration-300 hover:bg-brand-orange/90 hover:shadow-lg hover:shadow-brand-orange/25 hover:-translate-y-0.5 group">
                                Contact Us
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            <a href="{{ route('landing') }}"
                               class="inline-flex items-center gap-2 px-7 py-3.5 border border-white/20 text-white rounded-full font-semibold text-sm
                                      transition-all duration-300 hover:bg-white/10 hover:-translate-y-0.5">
                                Explore Collection
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="rounded-3xl overflow-hidden shadow-2xl">
                            <img class="w-full h-72 sm:h-80 object-cover" src="{{ asset('assets/parallax-img.png') }}" alt="Transform your space with JumpStart">
                        </div>
                        {{-- Floating accent --}}
                        <div class="absolute -top-3 -right-3 w-12 h-12 rounded-full bg-brand-orange flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>