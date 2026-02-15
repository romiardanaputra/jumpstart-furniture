@section('title_web_page', 'Dashboard')

<x-app-user-layout>
    <div class="space-y-10 animate-fade-in-up">
        
        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-8 rounded-[2rem] bg-white border border-brand-peach flex items-center justify-between shadow-sm hover:shadow-xl hover:shadow-brand-orange/5 transition-all group">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-orange mb-2">My Wishlist</p>
                    <h3 class="text-4xl font-black text-brand-dark tracking-tighter">{{ auth()->user()->wishlists()->count() }}</h3>
                    <p class="text-xs text-zinc-400 mt-2">Treasured items found</p>
                </div>
                <div class="w-16 h-16 rounded-3xl bg-brand-cream flex items-center justify-center group-hover:scale-110 group-hover:bg-brand-orange/10 transition-all">
                    <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
            </div>

            <div class="p-8 rounded-[2rem] bg-brand-dark text-white flex items-center justify-between shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-orange/20 rounded-full blur-3xl -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-orange mb-2">Active Orders</p>
                    <h3 class="text-4xl font-black text-white tracking-tighter">03</h3>
                    <p class="text-xs text-zinc-500 mt-2">On the way home</p>
                </div>
                <div class="relative z-10 w-16 h-16 rounded-3xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:scale-110 transition-all">
                    <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
            </div>

            <div class="p-8 rounded-[2rem] bg-white border border-brand-peach flex items-center justify-between shadow-sm hover:shadow-xl hover:shadow-brand-orange/5 transition-all group">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand-orange mb-2">Total Savings</p>
                    <h3 class="text-4xl font-black text-brand-dark tracking-tighter">Rp 2.5jt</h3>
                    <p class="text-xs text-zinc-400 mt-2">From premium coupons</p>
                </div>
                <div class="w-16 h-16 rounded-3xl bg-brand-cream flex items-center justify-center group-hover:scale-110 group-hover:bg-brand-orange/10 transition-all">
                    <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        {{-- Main Row --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
            {{-- Best Products section (Modified for Dashboard context) --}}
            <div class="xl:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h4 class="text-xl font-black text-brand-dark tracking-tight">Recommended Collection</h4>
                    <a href="{{ route('shop') }}" class="text-xs font-black uppercase tracking-widest text-brand-orange hover:translate-x-1 transition-transform inline-flex items-center gap-2">Explore Shop <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                </div>
                <div class="bg-white rounded-[2.5rem] p-4 border border-brand-peach/50 shadow-sm">
                    <x-best-product />
                </div>
            </div>

            {{-- Sidebar for Dashboard --}}
            <div class="xl:col-span-1 space-y-8">
                <div class="p-8 rounded-[2.5rem] bg-brand-peach/20 border border-brand-peach/50 space-y-6">
                    <h4 class="text-lg font-black text-brand-dark tracking-tight">Inspiration Feed</h4>
                    <div class="space-y-4">
                        {{-- Simulating blog cards for dashboard --}}
                        <div class="flex gap-4 group cursor-pointer">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 border border-brand-peach/50">
                                <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Inspo">
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-black text-brand-orange tracking-widest mb-1">Modern Living</p>
                                <h5 class="text-xs font-black text-brand-dark leading-tight group-hover:text-brand-orange transition-colors">Minimalist Decor Tips for your small Studio</h5>
                            </div>
                        </div>
                        <div class="flex gap-4 group cursor-pointer">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 border border-brand-peach/50">
                                <img src="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Inspo">
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-black text-brand-orange tracking-widest mb-1">Craftsmanship</p>
                                <h5 class="text-xs font-black text-brand-dark leading-tight group-hover:text-brand-orange transition-colors">The Japanese Art of Joinery in Modern Tables</h5>
                            </div>
                        </div>
                    </div>
                    <x-ui.button variant="outline" href="{{ route('blog') }}" class="w-full rounded-2xl">View More Stories</x-ui.button>
                </div>
            </div>
        </div>

    </div>
</x-app-user-layout>