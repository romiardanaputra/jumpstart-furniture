<div class="bg-[#EAE8E7]">
    <div class="container mx-auto p-[5rem] py-[10rem]">
        <footer class="w-full border-t border-border bg-muted/40 py-12 md:py-16">
            <div class="mx-auto max-w-screen-xl grid grid-cols-1 gap-12 px-4 sm:grid-cols-2 md:grid-cols-4 sm:px-6 lg:px-8 text-center sm:text-left">
                <div class="flex flex-col gap-4">
                    <a href="{{ route('landing') }}" class="flex items-center justify-center sm:justify-start space-x-2">
                        <img src="{{ asset('assets/icons/Jumpstart.png') }}" class="h-8 w-8" alt="Logo" />
                        <span class="font-bold tracking-tight text-lg">Jumpstart</span>
                    </a>
                    <p class="text-sm text-muted-foreground leading-relaxed max-w-xs mx-auto sm:mx-0">
                        Crafting premium furniture experiences with a commitment to quality and minimalist elegance.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-sm font-semibold mb-6 uppercase tracking-wider text-foreground">Discover</h4>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li><a href="{{ route('landing') }}" class="hover:text-foreground transition-colors">Collection</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-foreground transition-colors">Our Story</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-foreground transition-colors">Get in Touch</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-foreground transition-colors">Journal</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold mb-6 uppercase tracking-wider text-foreground">Connect</h4>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li><a href="#" class="hover:text-foreground transition-colors">Instagram</a></li>
                        <li><a href="#" class="hover:text-foreground transition-colors">Pinterest</a></li>
                        <li><a href="#" class="hover:text-foreground transition-colors">Discord Community</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold mb-6 uppercase tracking-wider text-foreground">Support</h4>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li><a href="{{ route('term') }}" class="hover:text-foreground transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('term') }}" class="hover:text-foreground transition-colors">Terms of Service</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-foreground transition-colors">Help Center</a></li>
                    </ul>
                </div>
            </div>

            <div class="mx-auto max-w-screen-xl mt-16 border-t border-border pt-8 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
                    <p class="text-xs text-muted-foreground">
                        © {{ date('Y') }} Romiardana. All rights reserved.
                    </p>
                    <div class="flex gap-6">
                        <!-- Social links simplified icons if needed -->
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>