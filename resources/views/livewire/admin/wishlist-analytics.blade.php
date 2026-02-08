<div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-3xl overflow-hidden">
    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Most Wishlisted Pieces</h3>
            <p class="text-xs text-zinc-500 mt-1">Products with the highest customer interest (Growth Trends).</p>
        </div>
        <div class="bg-zinc-100 dark:bg-zinc-800 p-2 rounded-xl">
            <svg class="w-5 h-5 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
        </div>
    </div>

    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
        @forelse($popularProducts as $item)
            <div class="p-4 flex items-center gap-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                <div class="h-12 w-12 rounded-xl overflow-hidden bg-zinc-100 dark:bg-zinc-800 flex-shrink-0">
                    <img src="{{ asset('storage/' . $item->product->product_image) }}" 
                        alt="{{ $item->product->product_name }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-zinc-900 dark:text-zinc-100 truncate capitalize">{{ $item->product->product_name }}</h4>
                    <p class="text-xs text-zinc-500 mt-0.5">{{ $item->product->category->category_name ?? 'Collection' }}</p>
                </div>
                <div class="text-right">
                    <span class="text-base font-black text-zinc-900 dark:text-zinc-100">{{ $item->wishlist_count }}</span>
                    <span class="block text-[10px] uppercase tracking-widest text-zinc-400 font-bold">Saves</span>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <p class="text-sm text-zinc-500 italic">No wishlist data available yet.</p>
            </div>
        @endforelse
    </div>

    @if($popularProducts->isNotEmpty())
        <div class="p-4 bg-zinc-50 dark:bg-zinc-900/50 border-t border-zinc-100 dark:border-zinc-800">
            <a href="{{ route('manage-product') }}" class="text-xs font-bold text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-100 flex items-center justify-center gap-2">
                <span>View Inventory Performance</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
    @endif
</div>
