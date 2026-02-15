@section('title_web_page', 'Privacy Policy — JumpStart Furniture')

<div class="bg-brand-cream font-satoshi min-h-screen">
    {{-- High-Quality Banner section --}}
    <x-banner-parallax 
        title="Privacy Policy" 
        subtitle="Your trust is our most valuable asset."
        image="https://images.unsplash.com/photo-1554034483-04fda0d3507b?auto=format&fit=crop&q=80&w=2000"
    />

    <section class="py-20 lg:py-32 px-6">
        <div class="max-w-4xl mx-auto">
            {{-- Main Content Card --}}
            <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-16 lg:p-20 relative overflow-hidden">
                {{-- Decorative brand accent --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-orange/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                
                <div class="relative z-10 space-y-12">
                    {{-- Introduction --}}
                    <div class="space-y-6">
                        <div class="inline-block px-4 py-1.5 bg-brand-orange/10 rounded-full">
                            <span class="text-brand-orange text-xs font-black uppercase tracking-widest">Version 2.0 — 2024</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black text-brand-dark tracking-tighter">Privacy <span class="text-brand-orange italic font-light">Matters.</span></h1>
                        <p class="text-lg text-muted-foreground leading-relaxed">
                            At <span class="text-brand-dark font-bold underline underline-offset-4 decoration-brand-orange/30">Jumpstart Furniture</span>, accessible from Furniqo, one of our main priorities is the privacy of our visitors.
                        </p>
                    </div>

                    <div class="h-px bg-brand-peach/20"></div>

                    {{-- Data Collection Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="md:col-span-1">
                            <h3 class="text-xl font-black text-brand-dark uppercase tracking-widest sticky top-32">01. Collection</h3>
                        </div>
                        <div class="md:col-span-2 space-y-4">
                            <p class="text-muted-foreground leading-relaxed">
                                We collect various types of information for several purposes to provide and improve our artisanal services to you.
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                                <div class="p-5 bg-brand-cream/30 rounded-2xl border border-brand-peach/10">
                                    <p class="text-brand-orange font-black text-xs uppercase tracking-widest mb-2">Personal Data</p>
                                    <p class="text-[11px] text-muted-foreground">Email, Name, Contact numbers, and Address for delivery excellence.</p>
                                </div>
                                <div class="p-5 bg-brand-cream/30 rounded-2xl border border-brand-peach/10">
                                    <p class="text-brand-orange font-black text-xs uppercase tracking-widest mb-2">Usage Data</p>
                                    <p class="text-[11px] text-muted-foreground">Cookies and usage metrics to enhance your aesthetic browsing journey.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h-px bg-brand-peach/10"></div>

                    {{-- Security Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="md:col-span-1">
                            <h3 class="text-xl font-black text-brand-dark uppercase tracking-widest sticky top-32">02. Security</h3>
                        </div>
                        <div class="md:col-span-2 space-y-6">
                            <p class="text-muted-foreground leading-relaxed">
                                The security of your data is important to us, but remember that no method of transmission over the Internet is 100% secure. 
                            </p>
                            <p class="text-muted-foreground text-sm italic border-l-4 border-brand-orange pl-6 py-2">
                                We strive to use commercially acceptable means to protect your personal information, including industry-standard encryption and periodic security audits.
                            </p>
                        </div>
                    </div>

                    <div class="h-px bg-brand-peach/10"></div>

                    {{-- Third Party section --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="md:col-span-1">
                            <h3 class="text-xl font-black text-brand-dark uppercase tracking-widest sticky top-32">03. Partners</h3>
                        </div>
                        <div class="md:col-span-2 space-y-6">
                            <p class="text-muted-foreground leading-relaxed">
                                We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf.
                            </p>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-xs text-brand-dark font-black tracking-widest uppercase">
                                    <div class="w-1.5 h-1.5 rounded-full bg-brand-orange"></div>
                                    Logistics Partners
                                </div>
                                <div class="flex items-center gap-3 text-xs text-brand-dark font-black tracking-widest uppercase">
                                    <div class="w-1.5 h-1.5 rounded-full bg-brand-orange"></div>
                                    Secure Payment Gateways
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Note --}}
                    <div class="pt-10 flex flex-col items-center text-center space-y-4">
                        <div class="w-12 h-1 bg-brand-orange/20 rounded-full"></div>
                        <p class="text-xs font-black text-brand-dark uppercase tracking-[0.3em]">Privacy by Design — Furniqo</p>
                        <p class="text-[10px] text-muted-foreground">Certified Premium Furniture Excellence</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
