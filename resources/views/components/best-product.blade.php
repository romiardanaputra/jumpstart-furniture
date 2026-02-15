@if($nested)
    {{-- Simple Adaptive Grid for Nested Contexts (e.g. Dashboard) --}}
    <div class="grid grid-cols-2 lg:grid-cols-2 2xl:grid-cols-3 gap-6">
        @forelse($products as $product)
            @include('components.product-card-simple', ['product' => $product])
        @empty
            <div class="col-span-full py-10 text-center text-zinc-400 font-medium italic"> No recommendations found yet. </div>
        @endforelse
    </div>
@else
    {{-- Full Section with Header (Landing Page Context) --}}
    <section class="bg-brand-cream py-16 sm:py-24 font-satoshi">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="flex flex-col items-center justify-center mb-12 text-center">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                    <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Best Sellers</span>
                    <div class="h-[2px] w-8 bg-brand-orange"></div>
                </div>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-foreground">Best Selling Products</h2>
            </div>

            {{-- Product Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
                @forelse($products as $product)
                    <a href="{{ route('product-detail', $product->product_id) }}" class="group">
                        <div class="bg-white rounded-2xl overflow-hidden border border-transparent hover:border-brand-orange/20
                                    shadow-sm hover:shadow-xl hover:shadow-brand-orange/5 transition-all duration-500 hover:-translate-y-1">
                            {{-- Image --}}
                            <div class="aspect-square w-full overflow-hidden bg-brand-peach/30 relative">
                                <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                     src="{{ str_starts_with($product->product_image, 'http') ? $product->product_image : asset('storage/'. $product->product_image) }}"
                                     alt="{{ $product->product_name }}">
                                {{-- Price badge --}}
                                <div class="absolute top-3 right-3 px-2.5 py-1 bg-white/90 backdrop-blur-sm rounded-full shadow-sm">
                                    <span class="text-xs font-bold text-brand-dark">${{ number_format($product->product_price, 0) }}</span>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="p-3 sm:p-4 space-y-2">
                                {{-- Rating --}}
                                <div class="flex items-center gap-0.5">
                                    @for($i = 0; $i < $product->product_rating; $i++)
                                        <svg class="w-3 h-3 text-brand-orange fill-brand-orange" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <h3 class="text-sm font-semibold text-foreground leading-tight line-clamp-1 group-hover:text-brand-orange transition-colors">
                                    {{ $product->product_name }}
                                </h3>
                                <p class="text-sm font-bold text-brand-dark">${{ number_format($product->product_price, 2) }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-brand-peach/50 flex items-center justify-center">
                            <svg class="w-8 h-8 text-brand-orange/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <p class="text-muted-foreground font-medium">No products found.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if(method_exists($products, 'links'))
                <div class="mt-12 flex justify-center custom-pagination">
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
            @endif
        </div>
    </section>
@endif
