@section('title_web_page', 'Dashboard')
@section('dashboard_title', 'Overview')

<div class="space-y-12 animate-fade-in-up">
    
    {{-- Header Section: Premium Greeting --}}
    <div class="relative overflow-hidden rounded-[2.5rem] bg-brand-dark p-10 lg:p-14 text-white shadow-2xl">
        {{-- Decorative elements matching landing hero --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-orange/20 rounded-full blur-[80px] -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-brand-peach/5 rounded-full blur-[60px] -ml-24 -mb-24"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-brand-orange/20 rounded-full border border-brand-orange/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-orange"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-brand-orange">Member Level: Elite</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter leading-none">
                    Welcome back, <br>
                    <span class="italic text-brand-orange font-light underline underline-offset-8 decoration-white/10">{{ auth()->user()->first_name }}!</span>
                </h1>
                <p class="text-zinc-400 text-sm max-w-md font-medium leading-relaxed">
                    Your curation of artisanal furniture is waiting. Explore today's new arrivals and exclusive member-only inspiration.
                </p>
            </div>
            
            <div class="hidden lg:block">
                <div class="w-24 h-24 rounded-full border-4 border-brand-orange/30 p-1">
                    <div class="w-full h-full rounded-full bg-brand-orange flex items-center justify-center font-black text-3xl italic text-white shadow-xl shadow-brand-orange/20">
                        {{ substr(auth()->user()->first_name, 0, 1) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stat Cards: Refined Glassmorphism --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {{-- Wishlist --}}
        <div class="p-8 rounded-[2.5rem] bg-white border border-brand-peach/50 flex items-center justify-between shadow-sm hover:shadow-2xl hover:shadow-brand-orange/5 transition-all duration-500 group group cursor-pointer">
            <div class="space-y-1">
                <p class="text-[10px] font-black uppercase tracking-widest text-brand-orange">My Wishlist</p>
                <h3 class="text-4xl font-black text-brand-dark tracking-tighter tabular-nums">{{ auth()->user()->wishlists()->count() }}</h3>
                <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-tight italic">Treasures discovered</p>
            </div>
            <div class="w-16 h-16 rounded-[1.5rem] bg-brand-cream flex items-center justify-center group-hover:scale-110 group-hover:bg-brand-orange/10 transition-all duration-500">
                <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </div>
        </div>

        {{-- Active Orders --}}
        <div class="p-8 rounded-[2.5rem] bg-brand-dark text-white flex items-center justify-between shadow-2xl relative overflow-hidden group cursor-pointer transition-all duration-500 hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-orange/20 rounded-full blur-[50px] -mr-16 -mt-16 group-hover:bg-brand-orange/30 transition-colors"></div>
            <div class="relative z-10 space-y-1">
                <p class="text-[10px] font-black uppercase tracking-widest text-brand-orange">Active Orders</p>
                <h3 class="text-4xl font-black text-white tracking-tighter tabular-nums">03</h3>
                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-tight italic">Coming home soon</p>
            </div>
            <div class="relative z-10 w-16 h-16 rounded-[1.5rem] bg-white/5 border border-white/10 flex items-center justify-center group-hover:scale-110 group-hover:bg-white/10 transition-all duration-500">
                <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
        </div>

        {{-- Total Savings --}}
        <div class="p-8 rounded-[2.5rem] bg-white border border-brand-peach/50 flex items-center justify-between shadow-sm hover:shadow-2xl hover:shadow-brand-orange/5 transition-all duration-500 group cursor-pointer">
            <div class="space-y-1">
                <p class="text-[10px] font-black uppercase tracking-widest text-brand-orange">Member Benefit</p>
                <h3 class="text-4xl font-black text-brand-dark tracking-tighter tabular-nums">Rp 2.5jt</h3>
                <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-tight italic">Exclusive savings</p>
            </div>
            <div class="w-16 h-16 rounded-[1.5rem] bg-brand-cream flex items-center justify-center group-hover:scale-110 group-hover:bg-brand-orange/10 transition-all duration-500">
                <svg class="w-8 h-8 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    {{-- Main Row: Collection & Feed --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
        {{-- Recommended Collection (Dynamic) --}}
        <div class="xl:col-span-2 space-y-8">
            <div class="flex items-center justify-between border-b border-brand-peach/50 pb-4">
                <div class="flex items-center gap-4">
                    <div class="w-1 h-8 bg-brand-orange rounded-full"></div>
                    <h4 class="text-2xl font-black text-brand-dark tracking-tighter">Recommended For You</h4>
                </div>
                <a href="{{ route('shop') }}" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-brand-orange hover:text-brand-dark transition-all">
                    Shop All 
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            
            <div class="bg-white rounded-[3rem] p-6 lg:p-10 border border-brand-peach/30 shadow-sm relative overflow-hidden group">
                {{-- Decorative background spot --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-brand-orange/5 rounded-full blur-[100px] opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                
                <div class="relative z-10">
                    <x-best-product :products="$products" :nested="true" />
                </div>
            </div>
        </div>

        {{-- Inspiration Feed (Compact & Dynamic) --}}
        <div class="xl:col-span-1 space-y-8">
            <div class="flex items-center gap-4 border-b border-brand-peach/50 pb-4">
                <div class="w-1 h-8 bg-brand-orange rounded-full"></div>
                <h4 class="text-2xl font-black text-brand-dark tracking-tighter">Inspiration Feed</h4>
            </div>

            <div class="bg-brand-cream/40 rounded-[2.5rem] p-8 space-y-8 border border-brand-peach/50 shadow-inner">
                <div class="space-y-6">
                    @foreach($blogs as $blog)
                        <a href="{{ route('blog-detail', $blog->blog_slug) }}" class="flex gap-5 group items-center">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 border border-brand-peach shadow-sm">
                                <img src="{{ asset('storage/' . $blog->blog_image) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                     alt="{{ $blog->blog_title }}">
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="text-[9px] uppercase font-black text-brand-orange tracking-widest">
                                    {{ $blog->blog_category->category_name ?? 'Collection' }}
                                </p>
                                <h5 class="text-xs font-black text-brand-dark leading-snug line-clamp-2 group-hover:text-brand-orange transition-colors">
                                    {{ $blog->blog_title }}
                                </h5>
                                <p class="text-[8px] text-zinc-400 font-bold uppercase tracking-tight italic">{{ $blog->created_at->format('M d, Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                <div class="pt-4">
                    <a href="{{ route('blog') }}" class="block text-center w-full py-4 bg-white border border-brand-peach rounded-2xl text-[10px] font-black uppercase tracking-widest text-brand-dark hover:bg-brand-orange hover:text-white hover:border-brand-orange hover:shadow-lg hover:shadow-brand-orange/20 transition-all duration-500">
                        View All Stories
                    </a>
                </div>
            </div>

            {{-- Promo Card in dashboard --}}
            <div class="relative overflow-hidden rounded-[2.5rem] bg-brand-dark p-8 text-white group cursor-pointer">
                <div class="absolute inset-0 bg-cover bg-center opacity-20 group-hover:scale-105 transition-transform duration-1000" style="background-image: url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&q=80&w=800')"></div>
                <div class="relative z-10 space-y-4">
                    <span class="inline-block px-3 py-1 bg-brand-orange text-white text-[9px] font-black uppercase tracking-widest rounded-full">Member Special</span>
                    <h4 class="text-xl font-black tracking-tight leading-tight">Elite curation for your living room.</h4>
                    <p class="text-xs text-white/60 font-medium">Get early access to our "Zen Series" collection.</p>
                </div>
            </div>
        </div>
    </div>

</div>
