<section class="bg-muted/30 py-16 sm:py-24">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-center mb-12 sm:mb-20 text-center">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-foreground">About Our Store</h2>
            <div class="h-1 w-20 bg-primary rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">
            <div class="relative group overflow-hidden rounded-2xl shadow-2xl">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                     src="{{ asset('assets/about.png') }}" alt="Our beautiful furniture store interior">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

            <div class="space-y-10">
                @php
                    $features = [
                        ['icon' => 'ship.svg', 'title' => 'World Wide Shipping', 'desc' => 'Reliable global delivery for all your furniture needs.'],
                        ['icon' => 'coin-money.svg', 'title' => 'Secure Payments', 'desc' => 'Fully encrypted payment processing for your peace of mind.'],
                        ['icon' => 'contact.svg', 'title' => '24/7 Support', 'desc' => 'Our dedicated team is always here to help you design your space.'],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 h-14 w-14 rounded-xl bg-background border border-border flex items-center justify-center shadow-sm transition-colors group-hover:border-primary/50">
                            <img class="h-7 w-7 transition-transform group-hover:scale-110" src="{{ asset('assets/icons/' . $feature['icon']) }}" alt="{{ $feature['title'] }}">
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-foreground leading-none mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-muted-foreground leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
