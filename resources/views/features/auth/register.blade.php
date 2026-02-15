@section('title_web_page', 'Create Account — JumpStart Furniture')

<div class="min-h-screen bg-brand-cream font-satoshi flex items-center justify-center p-4 sm:p-6 lg:p-0">
    <div class="max-w-6xl w-full bg-white rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col lg:flex-row min-h-[700px] lg:min-h-[850px]">
        
        {{-- Left Side: Visual Experience (Differentiated from Login) --}}
        <div class="lg:w-2/5 relative hidden lg:block overflow-hidden">
            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&q=80&w=1200" 
                 alt="Artisanal Workspace" 
                 class="absolute inset-0 w-full h-full object-cover transition-transform duration-[20s] hover:scale-110">
            
            {{-- Aesthetic Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/60 via-brand-dark/20 to-transparent text-white p-12 flex flex-col justify-end">
                <div class="max-w-xs space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-brand-orange/20 backdrop-blur-md rounded-full border border-white/10 uppercase tracking-[0.2em] text-[10px] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-orange"></span>
                        Premium Access
                    </div>
                    <h2 class="text-4xl font-bold leading-tight">Start your <span class="text-brand-orange italic">aesthetic</span> journey with us.</h2>
                    <p class="text-white/70 text-sm leading-relaxed">Unlock exclusive collections, personalized design tips, and early access to our seasonal artisanal pieces.</p>
                </div>
            </div>

            {{-- Brand Wordmark Overlay --}}
            <div class="absolute top-12 left-12 flex items-center gap-3">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-8 w-auto invert brightness-0" alt="JumpStart">
                <span class="text-white font-black text-xl tracking-tighter uppercase italic">Furniqo</span>
            </div>
        </div>

        {{-- Right Side: Register Form --}}
        <div class="lg:w-3/5 p-8 sm:p-12 lg:p-16 flex flex-col justify-center relative overflow-hidden bg-white">
            {{-- Decorative accent --}}
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-orange/5 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 w-full max-w-lg mx-auto space-y-8">
                {{-- Header --}}
                <div class="space-y-2">
                    <h1 class="text-3xl font-black text-brand-dark tracking-tight">Create <span class="text-brand-orange italic font-light">Account</span></h1>
                    <p class="text-muted-foreground text-sm">Join the community of fine furniture enthusiasts.</p>
                </div>

                <x-jet-validation-errors class="mb-4" />

                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Name Row --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="first_name" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">First Name</label>
                            <input type="text" name="first_name" id="first_name" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="John" required :value="old('first_name')" autofocus>
                        </div>
                        <div class="space-y-2">
                            <label for="last_name" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Last Name</label>
                            <input type="text" name="last_name" id="last_name" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="Doe" required :value="old('last_name')">
                        </div>
                    </div>

                    {{-- Contact & Email Row --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="contact" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Contact</label>
                            <input type="tel" name="contact" id="contact" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="0812-3456-7890" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4,}" required :value="old('contact')">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Email</label>
                            <input type="email" name="email" id="email" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="hello@lux.com" required :value="old('email')">
                        </div>
                    </div>

                    {{-- Role Selection (Styled Peer) --}}
                    <div class="space-y-2">
                        <label for="underline_select" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Join As</label>
                        <div class="relative">
                            <select id="underline_select" name="role" 
                                    class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark text-sm appearance-none focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300 peer"
                                    required>
                                <option value="" disabled selected>Select your role...</option>
                                <option value="admin">Administrator</option>
                                <option value="member">Valued Member</option>
                            </select>
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-brand-orange">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Password Row --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="password" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Password</label>
                            <input type="password" name="password" id="password" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="••••••••" required>
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-xs font-black text-brand-dark uppercase tracking-widest pl-1">Confirm</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="w-full px-5 py-4 bg-brand-cream/30 border border-brand-peach/30 rounded-2xl text-brand-dark placeholder:text-muted-foreground/50 text-sm focus:outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all duration-300"
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="flex items-start space-x-3 pl-1 pt-2">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox"
                                   class="w-5 h-5 rounded-lg border-brand-peach/50 text-brand-orange focus:ring-brand-orange transition-all cursor-pointer" 
                                   required>
                        </div>
                        <label for="terms" class="text-xs text-muted-foreground leading-tight italic">
                            I agree to the <a href="{{ route('term') }}" class="text-brand-dark font-black underline underline-offset-4 hover:text-brand-orange transition-colors">Terms and Conditions</a>.
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-brand-orange text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-brand-orange/20 hover:bg-brand-dark hover:shadow-brand-dark/20 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                        Create Account
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                {{-- Footer link --}}
                <div class="text-center pt-2">
                    <p class="text-xs text-muted-foreground">Already a connoisseur? <a href="{{ route('login') }}" class="text-brand-dark font-black hover:text-brand-orange transition-colors underline underline-offset-4">Sign In Instead</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
