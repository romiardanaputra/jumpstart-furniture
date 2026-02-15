{{-- Blog Section --}}
<section class="py-16 sm:py-24 font-satoshi relative">
    {{-- Header Section with Modern Flair --}}
    <div class="mb-16 relative">
        <div class="flex flex-col items-center justify-center text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-brand-orange/10 rounded-full border border-brand-orange/20">
                <div class="h-2 w-2 rounded-full bg-brand-orange animate-pulse"></div>
                <span class="text-brand-orange font-bold text-xs uppercase tracking-[0.2em]">Our Stories</span>
            </div>
            
            <h2 class="text-4xl sm:text-5xl font-black text-brand-dark tracking-tight">
                Design <span class="text-brand-orange italic font-light">Inspirations</span>
            </h2>
            
            <p class="text-muted-foreground/80 max-w-xl text-lg leading-relaxed">
                Step inside the world of premium artisanal craftsmanship—where legacy meets modern aesthetics.
            </p>
        </div>
        
        {{-- Side Accents --}}
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-brand-orange/5 rounded-full blur-3xl -z-10"></div>
    </div>

    {{-- Blog Grid Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
        @foreach($blogs as $blog)
            <article class="group relative flex flex-col h-full bg-white rounded-[2.5rem] border border-brand-peach/20 overflow-hidden shadow-sm hover:shadow-2xl hover:shadow-brand-orange/10 transition-all duration-700 hover:-translate-y-2">
                {{-- Image Container --}}
                <div class="aspect-[4/3] w-full overflow-hidden relative">
                    <img class="h-full w-full object-cover transition-transform duration-1000 ease-out group-hover:scale-110"
                         src="{{ str_starts_with($blog->blog_image, 'http') ? $blog->blog_image : asset('storage/'. $blog->blog_image) }}" 
                         alt="{{ $blog->blog_title }}">
                    
                    {{-- Category/Date Badge --}}
                    <div class="absolute top-6 right-6 flex flex-col items-center bg-white/95 backdrop-blur-sm px-3 py-2 rounded-2xl shadow-lg border border-white/20">
                        <span class="text-brand-dark font-black text-lg">{{ $blog->created_at->format('d') }}</span>
                        <span class="text-brand-orange font-bold text-[10px] uppercase tracking-wider">{{ $blog->created_at->format('M') }}</span>
                    </div>

                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                {{-- Content Body --}}
                <div class="p-8 sm:p-10 flex flex-col flex-grow space-y-4">
                    <div class="flex items-center gap-3 text-brand-orange/60 text-xs font-bold uppercase tracking-widest">
                        <span>{{ $blog->tags ?? 'Inspiration' }}</span>
                        <div class="h-1 w-1 rounded-full bg-brand-orange/30"></div>
                        <span>{{ ceil(str_word_count($blog->blog_long_description) / 200) }} min read</span>
                    </div>

                    <h3 class="text-2xl font-bold text-brand-dark group-hover:text-brand-orange transition-colors duration-300 leading-tight line-clamp-2">
                        {{ $blog->blog_title }}
                    </h3>

                    <p class="text-muted-foreground/70 text-base leading-relaxed line-clamp-3">
                        {{ $blog->blog_long_description }}
                    </p>

                    <div class="pt-6 mt-auto">
                        <a href="{{ route('blog-detail', $blog->blog_id) }}" 
                           class="inline-flex items-center gap-3 text-brand-dark font-black text-sm group/btn">
                            <span class="relative">
                                Read Article
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-orange transition-all duration-500 group-hover/btn:w-full"></span>
                            </span>
                            <div class="w-8 h-8 rounded-full bg-brand-cream border border-brand-peach/30 flex items-center justify-center group-hover/btn:bg-brand-orange group-hover/btn:text-white transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    {{-- Enhanced Pagination Wrapper --}}
    @if(method_exists($blogs, 'links'))
        <div class="mt-20">
            {{ $blogs->links('vendor.pagination.custom') }}
        </div>
    @endif
</section>
