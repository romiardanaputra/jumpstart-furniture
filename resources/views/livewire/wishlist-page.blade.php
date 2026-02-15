@section('dashboard_title', 'My Wishlist')

<div class="space-y-10 animate-fade-in-up">
    <div class="max-w-7xl mx-auto">
        
        @if($wishlistItems->isEmpty())
            <div class="text-center py-32 bg-white rounded-[3rem] border border-brand-peach/50 shadow-sm">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-brand-cream mb-8 text-brand-orange/30">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-brand-dark tracking-tighter mb-4">Your saved collection is <span class="text-brand-orange italic font-light">empty.</span></h3>
                <p class="text-zinc-400 mb-10 max-w-sm mx-auto text-sm leading-relaxed">Discover our artisanal pieces and save those that inspire you for your future home.</p>
                <a href="{{ route('shop') }}" class="inline-flex items-center justify-center px-10 py-4 rounded-2xl bg-brand-dark text-white font-black text-xs uppercase tracking-widest hover:bg-brand-orange hover:shadow-xl hover:shadow-brand-orange/20 transition-all duration-500">
                    Explore Shop
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($wishlistItems as $item)
                    <div class="group relative bg-white border border-brand-peach/30 rounded-[2.5rem] overflow-hidden hover:shadow-2xl hover:shadow-brand-orange/5 transition-all duration-700 h-full flex flex-col">
                        <!-- Image -->
                        <div class="aspect-square relative overflow-hidden bg-brand-cream/50">
                            <img src="{{ asset('storage/' . $item->product->product_image) }}" 
                                alt="{{ $item->product->product_name }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            
                            {{-- Remove Button --}}
                            <button 
                                wire:click="removeFromWishlist({{ $item->product_id }})"
                                class="absolute top-6 right-6 p-4 bg-white/90 backdrop-blur-md rounded-2xl text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-xl shadow-black/5"
                                title="Remove from wishlist"
                            >
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                            </button>

                            {{-- Category Badge --}}
                            <div class="absolute bottom-6 left-6">
                                <span class="px-4 py-1.5 rounded-full bg-brand-dark/80 backdrop-blur-md text-[10px] font-black uppercase tracking-widest text-white border border-white/20">
                                    {{ $item->product->category->category_name }}
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-8 flex-1 flex flex-col gap-4">
                            <div class="space-y-2">
                                <h4 class="text-2xl font-black text-brand-dark tracking-tight truncate line-clamp-1">
                                    <a href="{{ route('product-detail', $item->product_id) }}" class="hover:text-brand-orange transition-colors">{{ $item->product->product_name }}</a>
                                </h4>
                                <p class="text-xs text-zinc-400 line-clamp-2 leading-relaxed h-8">{{ $item->product->product_short_description }}</p>
                            </div>
                            
                            <div class="mt-auto pt-6 border-t border-brand-cream flex items-center justify-between">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-brand-orange uppercase tracking-widest">Investment</p>
                                    <p class="text-2xl font-black text-brand-dark tracking-tighter tabular-nums">Rp {{ number_format($item->product->product_price ?: ($item->product->skus->first()->sku_price ?? 0), 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ route('product-detail', $item->product_id) }}" class="w-14 h-14 bg-brand-dark text-white rounded-2xl flex items-center justify-center hover:bg-brand-orange hover:shadow-lg hover:shadow-brand-orange/20 hover:-translate-y-1 transition-all duration-300">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
