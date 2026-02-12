{{-- Blog Section --}}
<section class="py-16 sm:py-24 font-satoshi">
    {{-- Section Header --}}
    <div class="flex flex-col items-center justify-center mb-12 text-center">
        <div class="flex items-center gap-3 mb-4">
            <div class="h-[2px] w-8 bg-brand-orange"></div>
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-widest">Journal</span>
            <div class="h-[2px] w-8 bg-brand-orange"></div>
        </div>
        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-foreground">From Our Blog</h2>
        <p class="text-muted-foreground mt-3 text-sm sm:text-base max-w-lg">
            Get inspired by the latest trends, design tips, and behind-the-scenes stories from our workshop.
        </p>
    </div>

    {{-- Blog Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @foreach($blogs as $blog)
            <a href="{{ route('blog-detail', $blog->blog_id) }}" class="group">
                <div class="bg-white rounded-2xl overflow-hidden border border-transparent
                            hover:border-brand-orange/20 hover:shadow-xl hover:shadow-brand-orange/5
                            transition-all duration-500 hover:-translate-y-1">
                    {{-- Image --}}
                    <div class="aspect-video w-full overflow-hidden relative">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                             src="{{ asset('storage/'. $blog->blog_image) }}" alt="{{ $blog->blog_title }}">
                        {{-- Date badge --}}
                        <div class="absolute top-4 left-4 px-3 py-1.5 bg-brand-orange text-white rounded-full shadow-md">
                            <time class="text-xs font-bold">{{ $blog->created_at->format('M d, Y') }}</time>
                        </div>
                        {{-- Gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent"></div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5 sm:p-6 space-y-3">
                        <h3 class="text-lg font-bold leading-tight text-foreground group-hover:text-brand-orange transition-colors line-clamp-2">
                            {{ $blog->blog_title }}
                        </h3>
                        <p class="line-clamp-2 text-sm text-muted-foreground leading-relaxed">
                            {{ $blog->blog_long_description }}
                        </p>
                        <div class="flex items-center gap-2 text-brand-orange text-sm font-semibold pt-1">
                            Read More
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>