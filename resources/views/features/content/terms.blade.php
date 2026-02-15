<x-guest-layout>
    <div class="min-h-screen bg-brand-cream font-satoshi py-12 px-6">
        <div class="max-w-4xl mx-auto flex flex-col items-center">
            <div class="mb-12 hover:scale-110 transition-transform duration-500">
                <x-jet-authentication-card-logo />
            </div>

            <div class="w-full bg-white shadow-2xl overflow-hidden rounded-[2.5rem] p-8 md:p-16 relative">
                {{-- Aesthetic background detail --}}
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-brand-orange/5 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 prose prose-brand-dark max-w-none prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase prose-p:text-muted-foreground prose-p:leading-relaxed">
                    {!! $terms !!}
                </div>

                {{-- Signature Footer --}}
                <div class="mt-16 pt-8 border-t border-brand-peach/20 text-center">
                    <p class="text-[10px] font-black text-brand-dark uppercase tracking-[0.4em]">JumpStart Furniqo Lifestyle</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
