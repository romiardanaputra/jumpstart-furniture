<section class="py-16 sm:py-24 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col items-center justify-center mb-12 text-center">
        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-foreground">Featured Collection</h2>
        <div class="h-1 w-20 bg-primary rounded-full mt-4"></div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @php
            $collections = [
                ['img' => 'white-vas.png', 'name' => 'Furniture White Vas Chine', 'price' => 250, 'rating' => 5],
                ['img' => 'blue-thin-vas.png', 'name' => 'Blue Thin Minimalist Vas', 'price' => 250, 'rating' => 5],
                ['img' => 'cream-table-ratan.png', 'name' => 'Cream Ratan Table', 'price' => 250, 'rating' => 5],
                ['img' => 'grey-mini-chair.png', 'name' => 'Grey Mini Accent Chair', 'price' => 250, 'rating' => 5],
                ['img' => 'red-chair.png', 'name' => 'Modern Red Lounge Chair', 'price' => 250, 'rating' => 5],
            ];
        @endphp

        @foreach ($collections as $item)
            <x-ui.card class="group border-none shadow-none hover:bg-accent/30 transition-colors p-0 overflow-hidden">
                <div class="aspect-[4/5] w-full bg-muted/50 overflow-hidden rounded-xl mb-4 relative">
                    <img class="h-full w-full object-contain p-4 transition-transform duration-500 group-hover:scale-110" 
                         src="{{ asset('assets/' . $item['img']) }}" alt="{{ $item['name'] }}" loading="lazy">
                    <div class="absolute top-2 right-2">
                        <x-ui.badge variant="secondary" class="bg-background/80 backdrop-blur-sm shadow-sm font-bold">
                            ${{ $item['price'] }}
                        </x-ui.badge>
                    </div>
                </div>
                <div class="px-2 pb-4 space-y-1">
                    <div class="flex items-center text-yellow-400">
                        @for ($i = 0; $i < $item['rating']; $i++)
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <h3 class="text-sm font-semibold text-foreground line-clamp-1 group-hover:text-primary transition-colors">{{ $item['name'] }}</h3>
                    <p class="text-xs text-muted-foreground uppercase tracking-widest leading-none">Best Seller</p>
                </div>
            </x-ui.card>
        @endforeach
    </div>
</section>
