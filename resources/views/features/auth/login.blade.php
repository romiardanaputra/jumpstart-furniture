@section('title_web_page', 'Login — JumpStart Furniture')

<div class="min-h-screen bg-brand-cream font-satoshi flex items-center justify-center p-4 sm:p-6 lg:p-0">
    <div class="max-w-6xl w-full bg-white rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col lg:flex-row min-h-[600px] lg:min-h-[700px]">
        
        {{-- Left Side: Visual Experience --}}
        <div class="lg:w-1/2 relative hidden lg:block overflow-hidden">
            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&q=80&w=1200" 
                 alt="Premium furniture setup" 
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-[20s] hover:scale-110">
            
            {{-- Aesthetic Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-br from-brand-dark/40 via-transparent to-brand-dark/20 text-white p-12 flex flex-col justify-end">
                <div class="max-w-sm space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-brand-orange/20 backdrop-blur-md rounded-full border border-white/10 uppercase tracking-[0.2em] text-[10px] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-orange"></span>
                        Est. 2024
                    </div>
                    <h2 class="text-4xl font-bold leading-tight">Elevate your living space with <span class="text-brand-orange">timeless</span> pieces.</h2>
                    <p class="text-white/70 text-sm leading-relaxed">Join our community of design enthusiasts and experience the art of artisanal craftsmanship.</p>
                </div>
            </div>

            {{-- Brand Wordmark Overlay --}}
            <div class="absolute top-12 left-12 flex items-center gap-3">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto invert brightness-0" alt="JumpStart">
                <span class="text-white font-black text-xl tracking-tighter uppercase italic">Furniqo</span>
            </div>
        </div>

        {{-- Right Side: Login Form --}}
        <div class="lg:w-1/2 p-8 sm:p-12 lg:p-20 flex flex-col justify-center relative overflow-hidden">
            {{-- Decorative accent --}}
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-orange/5 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 w-full max-w-sm mx-auto space-y-8">
                {{-- Header --}}
                <div class="space-y-2">
                    <h1 class="text-3xl font-black text-brand-dark tracking-tight">Welcome <span class="text-brand-orange italic font-light">Back</span></h1>
                    <p class="text-muted-foreground text-sm">Please enter your details to sign in.</p>
                </div>

                <x-jet-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-2xl border border-green-100 italic">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Email Field --}}
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Email Address</label>
                        <div class="relative group">
                            <input type="email" name="email" id="email" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="e.g. hello@furniqo.com" 
                                   required :value="old('email')" autofocus>
                            <div class="absolute inset-y-0 right-5 flex items-center text-muted-foreground/30 group-focus-within:text-brand-orange transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Password Field --}}
                    <div class="space-y-2">
                        <div class="flex items-center justify-between pl-1">
                            <label for="password" class="text-xs font-black text-brand-dark uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-brand-orange hover:text-brand-dark uppercase tracking-tighter transition-colors">Forgot?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <input type="password" name="password" id="password" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="••••••••" 
                                   required>
                            <div class="absolute inset-y-0 right-5 flex items-center text-muted-foreground/30 group-focus-within:text-brand-orange transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Remember Me & Action --}}
                    <div class="flex items-center space-x-2 pl-1">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="w-4 h-4 rounded border-brand-peach/50 text-brand-orange focus:ring-brand-orange">
                        <label for="remember_me" class="text-xs font-medium text-muted-foreground italic">Keep me signed in</label>
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-brand-orange text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-brand-orange/20 hover:bg-brand-dark hover:shadow-brand-dark/20 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 group">
                        Sign In
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 uppercase" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                {{-- Footer link --}}
                <div class="text-center pt-4">
                    <p class="text-xs text-muted-foreground">New to JumpStart? <a href="{{ route('register') }}" class="text-brand-dark font-black hover:text-brand-orange transition-colors underline underline-offset-4">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
