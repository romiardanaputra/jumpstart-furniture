@props(['product'])

@php
    $defaultSku = $product->skus->first();
    $price = $defaultSku ? $defaultSku->sku_price : 0;
    $stock = $defaultSku ? $defaultSku->sku_stock : 0;
@endphp

<div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-zinc-200/50 dark:hover:shadow-none transition-all duration-300">
    <!-- Image -->
    <div class="aspect-[4/5] w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800 relative">
        <img src="{{ asset('storage/' . $product->product_image) }}" 
            alt="{{ $product->product_name }}"
            onerror="this.src='https://placehold.co/400x500/18181b/ffffff?text={{ urlencode($product->product_name) }}'"
            class="h-full w-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
        
        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
             <a href="{{ route('product-detail', $product->product_id) }}" 
                class="bg-white text-zinc-900 p-3 rounded-full hover:bg-zinc-900 hover:text-white transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
             </a>
        </div>

        @if($product->product_discount)
            <div class="absolute top-4 left-4">
                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md">{{ $product->product_discount }}% OFF</span>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ $product->category->category_name ?? 'Furniture' }}</span>
            <div class="flex items-center gap-1">
                <svg class="h-3 w-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span class="text-xs font-bold text-zinc-900 dark:text-zinc-100">{{ $product->product_rating }}</span>
            </div>
        </div>
        
        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100 mb-2 truncate">
            {{ $product->product_name }}
        </h3>

        <div class="flex items-center justify-between mt-4">
            <div>
                @if($product->product_discount)
                    <p class="text-xs text-zinc-400 line-through">Rp {{ number_format($price * (1 + $product->product_discount/100), 0, ',', '.') }}</p>
                @endif
                <p class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Rp {{ number_format($price, 0, ',', '.') }}</p>
            </div>
            
            <button class="bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-2.5 rounded-xl hover:bg-zinc-900 hover:text-white dark:hover:bg-white dark:hover:text-zinc-900 transition-all duration-300">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </button>
        </div>
    </div>
</div>
