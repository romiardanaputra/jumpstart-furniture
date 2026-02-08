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
                                <svg class="h-4 w-4 {{ $i < floor($averageRating ?: $product->product_rating) ? 'text-yellow-400 fill-current' : 'text-zinc-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <span class="ml-2 text-sm text-zinc-500 font-medium">({{ number_format($averageRating ?: $product->product_rating, 1) }} / 5 from {{ $reviews->count() ?: 1 }} reviews)</span>
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

                    @livewire('wishlist-button', ['productId' => $product->product_id], key('wishlist-detail-'.$product->product_id))
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

        <!-- Reviews Section -->
        <div class="mt-24 pt-24 border-t border-zinc-100 dark:border-zinc-900">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
                <div class="lg:col-span-4">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-4">Customer Experience</h2>
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-5xl font-black text-zinc-900 dark:text-zinc-100">{{ number_format($averageRating ?: $product->product_rating, 1) }}</span>
                        <div class="flex flex-col">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= floor($averageRating ?: $product->product_rating) ? 'text-yellow-400 fill-current' : 'text-zinc-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <span class="text-xs text-zinc-500 font-medium mt-1">Based on {{ $reviews->count() }} reviews</span>
                        </div>
                    </div>

                    @auth
                        @livewire('leave-review', ['productId' => $product->product_id])
                    @else
                        <div class="bg-zinc-50 dark:bg-zinc-900/50 p-6 rounded-2xl border border-zinc-100 dark:border-zinc-800 text-center">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">Have you purchased this piece? Log in to share your thoughts.</p>
                            <a href="{{ route('login') }}" class="text-sm font-bold text-zinc-900 dark:text-white underline">Sign In</a>
                        </div>
                    @endauth
                </div>

                <div class="mt-16 lg:mt-0 lg:col-span-8 space-y-10">
                    @forelse($reviews as $review)
                        <div class="bg-white dark:bg-zinc-950 border border-zinc-100 dark:border-zinc-900 p-8 rounded-3xl shadow-sm">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-900 dark:text-zinc-100 font-bold uppercase">
                                        {{ substr($review->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $review->user->name }}</h4>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @if($review->is_verified)
                                                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 px-2 py-0.5 rounded">
                                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                    Verified Purchase
                                                </span>
                                            @endif
                                            <span class="text-[10px] text-zinc-400 font-medium">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-3.5 w-3.5 {{ $i <= $review->rating ? 'text-yellow-400 fill-current' : 'text-zinc-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm leading-relaxed mb-6">{{ $review->comment }}</p>
                            
                            @if($review->images)
                                <div class="flex flex-wrap gap-3">
                                    @foreach($review->images as $photo)
                                        <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="block w-24 h-24 rounded-2xl overflow-hidden border border-zinc-100 dark:border-zinc-900 group">
                                            <img src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="bg-zinc-50 dark:bg-zinc-900/50 p-12 rounded-3xl border border-zinc-100 dark:border-zinc-800 text-center">
                            <div class="h-16 w-16 rounded-2xl bg-white dark:bg-zinc-800 flex items-center justify-center mx-auto mb-6 text-zinc-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-2">No reviews yet</h3>
                            <p class="text-sm text-zinc-500">Be the first to share your experience with this item.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
