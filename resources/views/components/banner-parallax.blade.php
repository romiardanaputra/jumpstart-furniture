@props(['title_page' => '', 'page_image' => ''])

<section class="relative overflow-hidden font-satoshi">
    <div style="background-image: url({{ $page_image }})"
         class="bg-center bg-no-repeat bg-cover bg-fixed h-[300px] sm:h-[350px] w-full">
        {{-- Dark green overlay with gradient --}}
        <div class="h-full w-full flex justify-center items-center"
             style="background: linear-gradient(135deg, hsla(160, 30%, 15%, 0.85), hsla(160, 30%, 15%, 0.7))">
            <div class="text-center px-4">
                <h1 class="text-white text-3xl sm:text-4xl font-bold tracking-tight mb-3">{{ $title_page }}</h1>
                <nav class="flex items-center justify-center gap-2 text-sm">
                    <a href="{{ route('landing') }}" class="text-white/60 hover:text-brand-orange transition-colors">Home</a>
                    <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-brand-orange font-medium">{{ $title_page }}</span>
                </nav>
            </div>
        </div>
    </div>
</section>