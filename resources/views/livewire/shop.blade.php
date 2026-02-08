<div class="py-12 bg-gray-50 dark:bg-zinc-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-64 space-y-8">
                <!-- Search -->
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-4">Search</h3>
                    <div class="relative">
                        <input wire:model.debounce.500ms="search" type="text" placeholder="Find furniture..." 
                            class="w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-lg py-2 px-4 text-sm focus:ring-2 focus:ring-zinc-500 focus:border-transparent transition-all">
                        <div class="absolute right-3 top-2.5 text-zinc-400">
                             <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-4">Categories</h3>
                    <div class="space-y-2">
                        <button wire:click="$set('category', null)" 
                            class="w-full text-left px-3 py-2 rounded-md text-sm transition-colors {{ is_null($category) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-900' }}">
                            All Products
                        </button>
                        @foreach($categories as $cat)
                            <button wire:click="$set('category', '{{ $cat->category_slug }}')" 
                                class="w-full text-left px-3 py-2 rounded-md text-sm transition-colors {{ $category === $cat->category_slug ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-900' }}">
                                {{ $cat->category_name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-4">Price Range</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <input wire:model.lazy="minPrice" type="number" placeholder="Min" class="w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-lg py-2 px-3 text-xs">
                            <span class="text-zinc-400">-</span>
                            <input wire:model.lazy="maxPrice" type="number" placeholder="Max" class="w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-lg py-2 px-3 text-xs">
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1">
                <!-- Toolbar -->
                <div class="flex items-center justify-between mb-8">
                    <p class="text-sm text-zinc-500">
                        Showing <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $products->count() }}</span> products
                    </p>
                    <select wire:model="sort" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-lg py-2 px-4 text-xs focus:ring-0">
                        <option value="latest">New Arrivals</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                    </select>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <x-shop.product-card :product="$product" />
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <h3 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">No products found</h3>
                            <p class="text-zinc-500 mt-2">Try adjusting your filters or search terms.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </main>
        </div>
    </div>
</div>
