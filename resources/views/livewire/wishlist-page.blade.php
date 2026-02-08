<div class="py-12 bg-white dark:bg-zinc-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100 italic">Saved Collections</h1>
            <p class="mt-2 text-lg text-zinc-500">Manage your personalized selection of furniture and design inspirations.</p>
        </header>

        @if($wishlistItems->isEmpty())
            <div class="text-center py-24 bg-zinc-50 dark:bg-zinc-900/50 rounded-3xl border border-dashed border-zinc-200 dark:border-zinc-800">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white dark:bg-zinc-800 shadow-xl mb-6 text-zinc-300">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mb-2">Your wishlist is empty</h3>
                <p class="text-zinc-500 mb-8 max-w-sm mx-auto">Start exploring our collection and save those pieces that catch your eye for later.</p>
                <a href="{{ route('landing') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold hover:scale-105 transition-all shadow-lg shadow-zinc-900/10">
                    Explore Collection
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($wishlistItems as $item)
                    <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-500 h-full flex flex-col">
                        <!-- Image -->
                        <div class="aspect-[4/5] relative overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                            <img src="{{ asset('storage/' . $item->product->product_image) }}" 
                                alt="{{ $item->product->product_name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <button 
                                wire:click="removeFromWishlist({{ $item->product_id }})"
                                class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-sm rounded-full text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm"
                                title="Remove from wishlist"
                            >
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                            </button>
                        </div>

                        <!-- Info -->
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">{{ $item->product->category->category_name }}</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-xs font-bold">{{ number_format($item->product->reviews_avg_rating ?: 0, 1) }}</span>
                                </div>
                            </div>
                            
                            <h4 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-2 truncate">
                                <a href="{{ route('product-detail', $item->product_id) }}" class="hover:underline">{{ $item->product->product_name }}</a>
                            </h4>
                            
                            <p class="text-sm text-zinc-500 line-clamp-2 mb-6 flex-1">{{ $item->product->product_short_description }}</p>

                            <div class="flex items-center justify-between mt-auto pt-6 border-t border-zinc-100 dark:border-zinc-800">
                                <span class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Rp {{ number_format($item->product->product_price ?: ($item->product->skus->first()->sku_price ?? 0), 0, ',', '.') }}</span>
                                <a href="{{ route('product-detail', $item->product_id) }}" class="p-3 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-xl hover:scale-110 active:scale-95 transition-all">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
