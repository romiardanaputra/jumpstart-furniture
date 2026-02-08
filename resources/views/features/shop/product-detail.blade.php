<div class="max-w-screen-xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    {{-- Breadcrumb Navigation --}}
    <nav class="flex mb-8 text-sm text-muted-foreground" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="hover:text-foreground transition-colors">Home</a>
            </li>
            <li class="flex items-center">
                <svg class="w-3 h-3 mx-1 text-muted-foreground/50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="#" class="ml-1 hover:text-foreground transition-colors">Products</a>
            </li>
            <li aria-current="page" class="flex items-center">
                <svg class="w-3 h-3 mx-1 text-muted-foreground/50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 font-medium text-foreground truncate max-w-[150px] sm:max-w-none">{{ $product->product_name }}</span>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        {{-- Product Image Section --}}
        <div class="relative aspect-square overflow-hidden rounded-lg bg-muted/30 border border-border">
            <img src="{{ asset('storage/'.$product->product_image) }}" alt="{{ $product->product_name }}" 
                 class="h-full w-full object-cover object-center transition-transform hover:scale-105 duration-700">
            @if($product->product_discount > 0)
                <div class="absolute top-4 left-4">
                    <x-ui.badge variant="destructive" class="text-sm px-3 py-1">-{{ $product->product_discount }}%</x-ui.badge>
                </div>
            @endif
        </div>

        {{-- Product Information Section --}}
        <div class="flex flex-col space-y-6">
            <div>
                <x-ui.badge variant="outline" class="mb-4">{{ $product->product_type }}</x-ui.badge>
                <h1 class="text-3xl sm:text-4xl font-bold text-foreground leading-tight capitalize">{{ $product->product_name }}</h1>
                
                <div class="flex items-center mt-4 space-x-4">
                    <div class="flex items-center text-primary">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 {{ $i < $product->product_rating ? 'fill-current' : 'text-muted/40' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm text-muted-foreground">({{ $product->product_rating }}/5.0)</span>
                    </div>
                    <span class="text-border">|</span>
                    <x-ui.badge variant="{{ str_contains(strtolower($product->product_availability), 'in stock') ? 'success' : 'outline' }}">
                        {{ $product->product_availability }}
                    </x-ui.badge>
                </div>
            </div>

            <div class="flex items-baseline space-x-3">
                <span class="text-3xl font-bold text-foreground">${{ number_format($product->product_price, 2) }}</span>
                @if($product->product_discount > 0)
                    <span class="text-xl text-muted-foreground line-through">${{ number_format($product->product_price * (1 + $product->product_discount/100), 2) }}</span>
                @endif
            </div>

            <p class="text-muted-foreground leading-relaxed text-lg">
                {{ $product->product_short_description }}
            </p>

            <div class="grid grid-cols-2 gap-y-4 text-sm border-y border-border/50 py-6">
                <div><span class="font-medium text-foreground">SKU:</span> <span class="text-muted-foreground">{{ $product->product_sku }}</span></div>
                <div><span class="font-medium text-foreground">Color:</span> <span class="text-muted-foreground">{{ $product->product_color }}</span></div>
                <div><span class="font-medium text-foreground">Vendor:</span> <span class="text-muted-foreground">{{ $product->product_vendor }}</span></div>
                <div><span class="font-medium text-foreground">Material:</span> <span class="text-muted-foreground">{{ $product->product_material }}</span></div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <x-ui.button wire:click="store_cart({{ $product->product_id }}, {{ $product->product_price }})" size="lg" class="flex-1">
                    Add to Cart
                </x-ui.button>
                <x-ui.button wire:click="store_cart_and_buy({{ $product->product_id }}, {{ $product->product_price }})" variant="outline" size="lg" class="flex-1">
                    Buy it Now
                </x-ui.button>
            </div>

            {{-- Accordion Details --}}
            <div id="product-accordion" class="pt-8 divide-y divide-border">
                <div x-data="{ open: false }" class="py-4">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-left font-medium text-foreground hover:text-primary transition-colors">
                        <span>Description</span>
                        <svg class="h-4 w-4 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak class="mt-4 text-muted-foreground text-sm leading-relaxed">
                        {{ $product->product_long_description }}
                    </div>
                </div>
                
                <div x-data="{ open: false }" class="py-4">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-left font-medium text-foreground hover:text-primary transition-colors">
                        <span>Shipping & Returns</span>
                        <svg class="h-4 w-4 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak class="mt-4 text-muted-foreground text-sm leading-relaxed">
                        {{ $product->product_shipping_and_return }}
                    </div>
                </div>

                <div x-data="{ open: false }" class="py-4">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-left font-medium text-foreground hover:text-primary transition-colors">
                        <span>Product Tags</span>
                        <svg class="h-4 w-4 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak class="mt-4 flex flex-wrap gap-2">
                        @foreach(explode(',', $product->product_tags) as $tag)
                            <x-ui.badge variant="secondary" class="rounded-full px-3">{{ trim($tag) }}</x-ui.badge>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products Section --}}
    <section class="mt-24 border-t border-border pt-16">
        <h2 class="text-2xl font-bold text-foreground mb-8">Related Products</h2>
        <x-best-product />
    </section>
</div>
