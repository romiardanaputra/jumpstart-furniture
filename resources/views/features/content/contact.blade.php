@section('title_web_page','Contact — JumpStart Furniture')

<div class="font-satoshi">

    {{-- ===== HERO SECTION ===== --}}
    <section class="relative bg-brand-dark overflow-hidden">
        {{-- Decorative --}}
        <div class="absolute top-0 right-1/4 w-72 h-72 bg-brand-orange/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-peach/5 rounded-full blur-2xl"></div>

        <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
            {{-- Breadcrumb --}}
            <nav class="flex justify-center items-center gap-2 text-sm mb-6">
                <a href="{{ route('landing') }}" class="text-white/50 hover:text-brand-orange transition-colors">Home</a>
                <svg class="w-3.5 h-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-brand-orange font-medium">Contact</span>
            </nav>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight">
                Get In <span class="text-brand-orange">Touch</span>
            </h1>
            <p class="text-white/50 text-base sm:text-lg mt-4 max-w-lg mx-auto leading-relaxed">
                Have a question or want to work together? We'd love to hear from you.
            </p>
        </div>

        {{-- Wave divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 60L1440 60L1440 30C1440 30 1200 0 720 0C240 0 0 30 0 30L0 60Z" fill="hsl(33, 90%, 95%)"/>
            </svg>
        </div>
    </section>

    {{-- ===== CONTACT INFO CARDS ===== --}}
    <section class="bg-brand-cream py-16 sm:py-20">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 sm:gap-6 -mt-28 sm:-mt-32 relative z-10">
                @php
                    $contactInfo = [
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                            'title' => 'Visit Us',
                            'line1' => 'Jl. Taman Sari Madu No.30',
                            'line2' => 'Kerobokan Kelod, Bali 80361',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                            'title' => 'Email Us',
                            'line1' => 'jumpstart@gmail.com',
                            'line2' => 'support@jumpstart.com',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
                            'title' => 'Call Us',
                            'line1' => '+62 123-456-7890',
                            'line2' => 'Mon - Sat, 9am - 6pm',
                        ],
                    ];
                @endphp

                @foreach ($contactInfo as $info)
                    <div class="bg-white rounded-2xl p-6 sm:p-8 text-center shadow-lg shadow-brand-dark/5
                                border border-transparent hover:border-brand-orange/20
                                hover:shadow-xl hover:shadow-brand-orange/5 hover:-translate-y-1
                                transition-all duration-500 group">
                        {{-- Icon --}}
                        <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-brand-peach/50 flex items-center justify-center
                                    group-hover:bg-brand-orange group-hover:shadow-lg group-hover:shadow-brand-orange/20 transition-all duration-300">
                            <svg class="w-6 h-6 text-brand-orange group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $info['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-dark mb-2">{{ $info['title'] }}</h3>
                        <p class="text-sm text-muted-foreground leading-relaxed">{{ $info['line1'] }}</p>
                        <p class="text-sm text-muted-foreground leading-relaxed">{{ $info['line2'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== FORM + MAP SECTION ===== --}}
    <section class="bg-brand-cream pb-16 sm:pb-24">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

                {{-- Contact Form --}}
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-lg shadow-brand-dark/5 border border-brand-peach/30">
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="h-[2px] w-6 bg-brand-orange"></div>
                            <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Message</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-brand-dark">Send Us a Message</h2>
                        <p class="text-muted-foreground mt-2 text-sm">Fill out the form below and we'll get back to you shortly.</p>
                    </div>

                    <form method="POST" action="" class="space-y-5">
                        @csrf
                        {{-- Name + Email --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-brand-dark mb-1.5">Full Name</label>
                                <input type="text" id="name" name="name" placeholder="Your name"
                                       class="w-full px-4 py-3 rounded-xl bg-brand-cream/50 border border-brand-peach/50
                                              text-brand-dark text-sm placeholder:text-muted-foreground/50
                                              focus:outline-none focus:border-brand-orange focus:ring-2 focus:ring-brand-orange/20
                                              transition-all duration-200">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-brand-dark mb-1.5">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="you@email.com"
                                       class="w-full px-4 py-3 rounded-xl bg-brand-cream/50 border border-brand-peach/50
                                              text-brand-dark text-sm placeholder:text-muted-foreground/50
                                              focus:outline-none focus:border-brand-orange focus:ring-2 focus:ring-brand-orange/20
                                              transition-all duration-200">
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-medium text-brand-dark mb-1.5">Subject</label>
                            <select id="subject" name="subject"
                                    class="w-full px-4 py-3 rounded-xl bg-brand-cream/50 border border-brand-peach/50
                                           text-brand-dark text-sm
                                           focus:outline-none focus:border-brand-orange focus:ring-2 focus:ring-brand-orange/20
                                           transition-all duration-200">
                                <option value="" disabled selected>Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Support</option>
                                <option value="custom">Custom Furniture</option>
                                <option value="partnership">Partnership</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-sm font-medium text-brand-dark mb-1.5">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tell us how we can help..."
                                      class="w-full px-4 py-3 rounded-xl bg-brand-cream/50 border border-brand-peach/50
                                             text-brand-dark text-sm placeholder:text-muted-foreground/50 resize-none
                                             focus:outline-none focus:border-brand-orange focus:ring-2 focus:ring-brand-orange/20
                                             transition-all duration-200"></textarea>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-brand-orange text-white rounded-full
                                       font-semibold text-sm shadow-md shadow-brand-orange/20
                                       hover:bg-brand-orange/90 hover:shadow-lg hover:shadow-brand-orange/30 hover:-translate-y-0.5
                                       transition-all duration-300 group">
                            Send Message
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Map --}}
                <div class="flex flex-col gap-6">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg shadow-brand-dark/5 border border-brand-peach/30 flex-1 min-h-[400px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5577.94783193845!2d115.1724312812821!3d-8.672070328029637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd247f0fd99a39b%3A0x9a24bac3e3a676e5!2sYayasan%20Suara%20Komunitas%20Satwa!5e0!3m2!1sid!2sid!4v1671712100430!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0; min-height: 400px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="JumpStart Location"
                            class="w-full h-full">
                        </iframe>
                    </div>

                    {{-- Quick Info Bar --}}
                    <div class="bg-brand-dark rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-brand-orange/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Working Hours</p>
                                <p class="text-white/50 text-xs">Mon – Sat: 9:00 AM – 6:00 PM</p>
                            </div>
                        </div>
                        <a href="{{ route('landing') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 border border-white/20 text-white rounded-full text-sm font-medium
                                  hover:bg-white/10 transition-all duration-300 group whitespace-nowrap">
                            View on Google Maps
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>