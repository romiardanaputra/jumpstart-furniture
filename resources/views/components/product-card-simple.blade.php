<a href="{{ route('product-detail', $product->product_id) }}" class="group">
    <div class="bg-white rounded-[2rem] overflow-hidden border border-brand-peach/30 
                hover:border-brand-orange/30 shadow-sm hover:shadow-2xl hover:shadow-brand-orange/5 transition-all duration-500 hover:-translate-y-1">
        {{-- Image --}}
        <div class="aspect-square w-full overflow-hidden bg-brand-peach/10 relative">
            <img class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                 src="{{ str_starts_with($product->product_image, 'http') ? $product->product_image : asset('storage/'. $product->product_image) }}"
                 alt="{{ $product->product_name }}">
            {{-- Price badge --}}
            <div class="absolute top-4 right-4 px-3 py-1.5 bg-brand-dark text-white rounded-full shadow-lg">
                <span class="text-[10px] font-black tabular-nums">${{ number_format($product->product_price, 0) }}</span>
            </div>
        </div>

        {{-- Info --}}
        <div class="p-5 space-y-2 text-center">
            <div class="flex items-center justify-center gap-0.5">
                @for($i = 0; $i < $product->product_rating; $i++)
                    <svg class="w-2.5 h-2.5 text-brand-orange fill-brand-orange" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
            <h3 class="text-xs font-black text-brand-dark leading-tight line-clamp-2 group-hover:text-brand-orange transition-colors">
                {{ $product->product_name }}
            </h3>
            <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">${{ number_format($product->product_price, 2) }}</p>
        </div>
    </div>
</a>
