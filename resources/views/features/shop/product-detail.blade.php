<div class="py-12 bg-white dark:bg-zinc-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
            
            <!-- Image Gallery -->
            <div class="flex flex-col">
                <div class="w-full aspect-[4/5] overflow-hidden rounded-3xl bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    <img src="{{ asset('storage/' . $product->product_image) }}" 
                        alt="{{ $product->product_name }}"
                        onerror="this.src='https://placehold.co/800x1000/18181b/ffffff?text={{ urlencode($product->product_name) }}'"
                        class="h-full w-full object-cover object-center">
                </div>
            </div>

            <!-- Product Info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <div class="mb-6">
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-xs text-zinc-500 uppercase tracking-wider">
                            <li><a href="{{ route('landing') }}" class="hover:text-zinc-900 dark:hover:text-zinc-100">Shop</a></li>
                            <li><svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                            <li class="text-zinc-900 dark:text-zinc-100">{{ $product->category->category_name }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100 sm:text-4xl">{{ $product->product_name }}</h1>
                    
                    <div class="mt-4 flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="h-4 w-4 {{ $i < floor($product->product_rating) ? 'text-yellow-400 fill-current' : 'text-zinc-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="ml-2 text-sm text-zinc-500 font-medium">({{ $product->product_rating }} Rating)</span>
                        </div>
                        <span class="h-4 w-px bg-zinc-200 dark:bg-zinc-800"></span>
                        <span class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold">{{ $sku->sku_stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                    </div>
                </div>

                <!-- Price -->
                <div class="mt-6 border-t border-zinc-100 dark:border-zinc-900 pt-6">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-4xl font-bold text-zinc-900 dark:text-zinc-100 tracking-tight">Rp {{ number_format($sku->sku_price, 0, ',', '.') }}</p>
                    <p class="mt-4 text-base text-zinc-500 leading-relaxed">{{ $product->product_short_description }}</p>
                </div>

                <!-- Variation Selectors -->
                <div class="mt-10 space-y-8">
                    @foreach($availableAttributes as $name => $data)
                        <div>
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-4">{{ $name }}</h3>
                            <div class="flex flex-wrap gap-3" x-data>
                                @foreach($data['values'] as $id => $valName)
                                    <button 
                                        wire:click="selectAttribute({{ $data['id'] }}, {{ $id }})"
                                        class="px-5 py-2.5 rounded-xl border-2 text-sm font-medium transition-all duration-200 
                                        {{ ($selectedAttributes[$data['id']] ?? null) == $id 
                                            ? 'border-zinc-900 bg-zinc-900 text-white dark:border-white dark:bg-white dark:text-zinc-950 shadow-lg' 
                                            : 'border-zinc-200 text-zinc-600 dark:border-zinc-800 dark:text-zinc-400 hover:border-zinc-400 dark:hover:border-zinc-600' }}">
                                        {{ $valName }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Multi-Column Info (Weight / Dimensions) -->
                <div class="mt-10 grid grid-cols-2 gap-4">
                    <div class="bg-zinc-50 dark:bg-zinc-900/50 p-4 rounded-2xl border border-zinc-100 dark:border-zinc-800">
                        <span class="block text-xs text-zinc-400 uppercase tracking-widest font-bold mb-1">Weight</span>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $sku->sku_weight }} kg</span>
                    </div>
                    <div class="bg-zinc-50 dark:bg-zinc-900/50 p-4 rounded-2xl border border-zinc-100 dark:border-zinc-800">
                        <span class="block text-xs text-zinc-400 uppercase tracking-widest font-bold mb-1">Dimensions</span>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ $sku->sku_dimensions['length'] ?? '-' }} x 
                            {{ $sku->sku_dimensions['width'] ?? '-' }} x 
                            {{ $sku->sku_dimensions['height'] ?? '-' }} cm
                        </span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <div class="flex items-center border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden bg-zinc-50 dark:bg-zinc-900">
                        <button wire:click="$decrement('quantity')" class="p-4 hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                        </button>
                        <input type="number" wire:model="quantity" class="w-12 text-center bg-transparent border-none text-zinc-900 dark:text-zinc-100 font-bold focus:ring-0">
                        <button wire:click="$increment('quantity')" class="p-4 hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                    
                    <button wire:click="addToCart" 
                        class="flex-1 bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 py-4 px-8 rounded-2xl font-bold hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-zinc-900/10 dark:shadow-none flex items-center justify-center gap-3">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Add to Selection
                    </button>
                </div>

                <!-- Descriptions Accordion -->
                <div class="mt-12 space-y-4 pt-12 border-t border-zinc-100 dark:border-zinc-900">
                    <div x-data="{ open: true }">
                        <button @click="open = !open" class="flex items-center justify-between w-full text-left">
                            <span class="text-sm font-bold text-zinc-900 dark:text-zinc-100 uppercase tracking-widest">Description</span>
                            <svg class="h-5 w-5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-collapse class="mt-4 text-sm text-zinc-500 leading-relaxed">
                            {{ $product->product_long_description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
