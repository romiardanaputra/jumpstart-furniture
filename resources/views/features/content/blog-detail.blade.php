@section('title_web_page', $blog->blog_title)

<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('blog') }}" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Blog
        </a>
    </div>

    <article class="space-y-12">
        <header class="space-y-6">
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <x-ui.badge variant="secondary" class="uppercase tracking-widest text-[10px]">
                        Article
                    </x-ui.badge>
                    <time class="text-sm text-muted-foreground">{{ $blog->created_at->format('M d, Y') }}</time>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-foreground leading-[1.1]">
                    {{ $blog->blog_title }}
                </h1>
                <div class="flex items-center space-x-3 pt-2">
                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr($blog->user->first_name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-foreground">{{ $blog->user->first_name }} {{ $blog->user->last_name }}</p>
                        <p class="text-xs text-muted-foreground">Author</p>
                    </div>
                </div>
            </div>

            <div class="aspect-video w-full overflow-hidden rounded-2xl bg-muted shadow-xl border border-border/50">
                <img class="h-full w-full object-cover" src="{{ asset('storage/'. $blog->blog_image) }}" alt="{{ $blog->blog_title }}">
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8">
                <div class="prose prose-lg dark:prose-invert max-w-none">
                    <p class="text-xl text-muted-foreground leading-relaxed font-medium mb-8">
                        {{ $blog->blog_tags }}
                    </p>
                    <div class="text-foreground leading-loose space-y-6 text-lg">
                        {!! nl2br(e($blog->blog_long_description)) !!}
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-border">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium text-muted-foreground">Share:</span>
                            <div class="flex space-x-2">
                                <button class="p-2 rounded-full hover:bg-muted transition-colors text-muted-foreground">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                </button>
                                <button class="p-2 rounded-full hover:bg-muted transition-colors text-muted-foreground">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="lg:col-span-4 space-y-8">
                <x-ui.card class="bg-muted/30 border-none">
                    <div class="space-y-4">
                        <h4 class="font-bold text-foreground">Subscribe to our newsletter</h4>
                        <p class="text-sm text-muted-foreground">Get the latest design trends and furniture tips delivered to your inbox.</p>
                        <div class="space-y-2">
                            <x-ui.input placeholder="Email address" />
                            <x-ui.button class="w-full">Subscribe</x-ui.button>
                        </div>
                    </div>
                </x-ui.card>

                <div class="space-y-4">
                    <h4 class="font-bold text-foreground">Related Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $blog->blog_tags) as $tag)
                            <x-ui.badge variant="outline" class="text-[10px] uppercase">
                                {{ trim($tag) }}
                            </x-ui.badge>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </article>
</div>
