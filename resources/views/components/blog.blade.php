<section class="my-24">
    <div class="flex flex-col items-center justify-center space-y-4 mb-10">
        <h2 class="text-3xl font-bold tracking-tight text-center sm:text-4xl text-foreground">From Our Blog</h2>
        <div class="h-1 w-20 bg-primary rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($blogs as $blog)
            <x-ui.card class="flex flex-col overflow-hidden border-none shadow-none hover:bg-accent/50 transition-colors group">
                <div class="aspect-video w-full overflow-hidden rounded-lg bg-muted">
                    <img class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110"
                        src="{{ asset('storage/'. $blog->blog_image) }}" alt="{{ $blog->blog_title }}">
                </div>
                <div class="flex flex-col gap-2 py-6">
                    <time class="text-xs font-medium uppercase tracking-wider text-primary">{{ $blog->created_at->format('M d, Y') }}</time>
                    <h3 class="text-xl font-bold leading-tight text-foreground transition-colors group-hover:text-primary">
                        <a href="{{ route('blog-detail', $blog->blog_id) }}">{{ $blog->blog_title }}</a>
                    </h3>
                    <p class="line-clamp-3 text-sm text-muted-foreground leading-relaxed">
                        {{ $blog->blog_long_description }}
                    </p>
                </div>
            </x-ui.card>
        @endforeach
    </div>
</section>