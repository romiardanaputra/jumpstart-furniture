{{-- Featured Collection Section --}}
<section class="bg-white py-16 sm:py-24 font-satoshi">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col items-center justify-center mb-12 text-center">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-[2px] w-8 bg-brand-orange"></div>
                <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Curated</span>
                <div class="h-[2px] w-8 bg-brand-orange"></div>
            </div>
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-foreground">Featured Collection</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
            @php
                $collections = [
                    ['img' => 'white-vas.png', 'name' => 'Furniture White Vas Chine', 'price' => 250, 'rating' => 5, 'tag' => 'New'],
                    ['img' => 'blue-thin-vas.png', 'name' => 'Blue Thin Minimalist Vas', 'price' => 250, 'rating' => 5, 'tag' => 'Popular'],
                    ['img' => 'cream-table-ratan.png', 'name' => 'Cream Ratan Table', 'price' => 250, 'rating' => 5, 'tag' => 'Trending'],
                    ['img' => 'grey-mini-chair.png', 'name' => 'Grey Mini Accent Chair', 'price' => 250, 'rating' => 5, 'tag' => 'Sale'],
                    ['img' => 'red-chair.png', 'name' => 'Modern Red Lounge Chair', 'price' => 250, 'rating' => 5, 'tag' => 'Best Seller'],
                ];
            @endphp

            @foreach ($collections as $item)
                <div class="group cursor-pointer">
                    <div class="bg-brand-peach/30 rounded-3xl overflow-hidden border border-transparent
                                hover:border-brand-orange/20 hover:shadow-xl hover:shadow-brand-orange/5
                                transition-all duration-500 hover:-translate-y-1">
                        {{-- Image --}}
                        <div class="aspect-[4/5] w-full overflow-hidden relative">
                            <img class="h-full w-full object-contain p-4 sm:p-6 transition-transform duration-500 group-hover:scale-110"
                                 src="{{ asset('assets/' . $item['img']) }}" alt="{{ $item['name'] }}" loading="lazy">

                            {{-- Price badge --}}
                            <div class="absolute top-3 right-3 px-3 py-1.5 bg-brand-orange text-white rounded-full shadow-md">
                                <span class="text-xs font-bold">${{ $item['price'] }}</span>
                            </div>

                            {{-- Tag badge --}}
                            <div class="absolute top-3 left-3 px-2.5 py-1 bg-white/90 backdrop-blur-sm rounded-full shadow-sm">
                                <span class="text-[10px] font-bold text-brand-dark uppercase tracking-wider">{{ $item['tag'] }}</span>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="px-4 pb-4 space-y-2">
                            <div class="flex items-center gap-0.5">
                                @for ($i = 0; $i < $item['rating']; $i++)
                                    <svg class="w-3 h-3 text-brand-orange fill-brand-orange" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <h3 class="text-sm font-semibold text-foreground line-clamp-1 group-hover:text-brand-orange transition-colors">
                                {{ $item['name'] }}
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
