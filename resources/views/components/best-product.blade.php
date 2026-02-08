<section class="my-16">
    <div class="flex flex-col items-center justify-center space-y-4 mb-10">
        <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl text-foreground capitalize">Best Selling Products</h2>
        <div class="h-1 w-20 bg-primary rounded-full"></div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse($products as $product)
            <a href="{{ route('product-detail', $product->product_id) }}" class="group">
                <x-ui.card class="h-full flex flex-col overflow-hidden border-none shadow-none hover:bg-accent/50 transition-colors">
                    <div class="aspect-square w-full overflow-hidden rounded-md bg-muted">
                        <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                            src="{{ asset('storage/'. $product->product_image) }}"
                            alt="{{ $product->product_name }}">
                    </div>
                    
                    <div class="flex flex-col gap-1.5 py-4">
                        <div class="flex items-center gap-1">
                            @for($i = 0 ; $i < $product->product_rating; $i++ )
                                <svg class="h-3 w-3 fill-primary text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            @endfor
                        </div>
                        <h3 class="text-sm font-medium leading-none text-foreground group-hover:underline">{{ $product->product_name }}</h3>
                        <p class="text-sm font-bold text-foreground mt-auto">${{ number_format($product->product_price, 2) }}</p>
                    </div>
                </x-ui.card>
            </a>
        @empty
            <div class="col-span-full py-12 text-center text-muted-foreground">No products found.</div>
        @endforelse
    </div>
</section>